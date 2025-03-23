<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use App\Models\PurchasePayment;
use App\Models\PurchaseReturn;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseInvoices = PurchaseInvoice::with('supplier')->get();
        return view('purchases.index', compact('purchaseInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $taxes = Tax::all();
        return view('purchases.create', compact('suppliers', 'products', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_date' => 'required|date',
            'round_off' => 'nullable|numeric',
            'global_discount' => 'nullable|numeric|min:0',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.tax_rate' => 'required|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Generate a unique invoice number
            $lastInvoice = PurchaseInvoice::latest()->first();
            $newInvoiceNumber = $lastInvoice ? 'INV-' . str_pad($lastInvoice->id + 1, 6, '0', STR_PAD_LEFT) : 'INV-000001';

            // Create the purchase invoice
            $purchaseInvoice = PurchaseInvoice::create([
                'invoice_number' => $newInvoiceNumber,
                'supplier_id' => $validatedData['supplier_id'],
                'invoice_date' => $validatedData['invoice_date'],
                'round_off' => $validatedData['round_off'] ?? 0,
                'global_discount' => $validatedData['global_discount'] ?? 0,
                'total_amount' => 0, // Will be updated later
            ]);

            $totalAmount = 0;

            // Loop through items and create purchase invoice items
            foreach ($validatedData['items'] as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discountAmount = ($subtotal * ($item['discount'] ?? 0)) / 100;
                $taxAmount = (($subtotal - $discountAmount) * $item['tax_rate']) / 100;
                $totalPrice = $subtotal - $discountAmount + $taxAmount;

                PurchaseInvoiceItem::create([
                    'purchase_invoice_id' => $purchaseInvoice->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'tax_rate' => $item['tax_rate'],
                    'discount' => $item['discount'] ?? 0,
                    'total_amount' => $totalPrice,
                ]);

                $totalAmount += $totalPrice;
            }

            // Apply global discount
            $globalDiscountAmount = ($totalAmount * ($validatedData['global_discount'] ?? 0)) / 100;
            $finalAmount = $totalAmount - $globalDiscountAmount;

            // Apply round off
            $roundedFinalAmount = round($finalAmount);
            $roundOff = $roundedFinalAmount - $finalAmount;

            // Update the total amount in the invoice
            $purchaseInvoice->update([
                'total_amount' => $roundedFinalAmount,
                'round_off' => $roundOff,
            ]);

            DB::commit();

            return redirect()->route('purchases.index')->with('success', 'Purchase Invoice Created Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseInvoice = PurchaseInvoice::with(['supplier', 'purchaseInvoiceItems.product'])->findOrFail($id);
        return view('purchases.show', compact('purchaseInvoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchaseInvoice = PurchaseInvoice::with('purchaseInvoiceItems')->findOrFail($id);
        $suppliers = Supplier::all();
        $products = Product::all();
        $taxes = Tax::all();
        return view('purchases.edit', compact('purchaseInvoice', 'suppliers', 'products', 'taxes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_date' => 'required|date',
            'round_off' => 'nullable|numeric',
            'global_discount' => 'nullable|numeric|min:0',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.tax_rate' => 'required|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $purchaseInvoice = PurchaseInvoice::findOrFail($id);

            // Update the purchase invoice
            $purchaseInvoice->update([
                'supplier_id' => $validatedData['supplier_id'],
                'invoice_date' => $validatedData['invoice_date'],
                'round_off' => $validatedData['round_off'] ?? 0,
                'global_discount' => $validatedData['global_discount'] ?? 0,
            ]);

            $totalAmount = 0;

            // Delete existing items and recreate them
            $purchaseInvoice->purchaseInvoiceItems()->delete();

            foreach ($validatedData['items'] as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discountAmount = ($subtotal * ($item['discount'] ?? 0)) / 100;
                $taxAmount = (($subtotal - $discountAmount) * $item['tax_rate']) / 100;
                $totalPrice = $subtotal - $discountAmount + $taxAmount;

                PurchaseInvoiceItem::create([
                    'purchase_invoice_id' => $purchaseInvoice->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'tax_rate' => $item['tax_rate'],
                    'discount' => $item['discount'] ?? 0,
                    'total_amount' => $totalPrice,
                ]);

                $totalAmount += $totalPrice;
            }

            // Apply global discount
            $globalDiscountAmount = ($totalAmount * ($validatedData['global_discount'] ?? 0)) / 100;
            $finalAmount = $totalAmount - $globalDiscountAmount;

            // Apply round off
            $roundedFinalAmount = round($finalAmount);
            $roundOff = $roundedFinalAmount - $finalAmount;

            // Update the total amount in the invoice
            $purchaseInvoice->update([
                'total_amount' => $roundedFinalAmount,
                'round_off' => $roundOff,
            ]);

            DB::commit();

            return redirect()->route('purchases.index')->with('success', 'Purchase Invoice Updated Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
    
        if ($product) {
            return response()->json([
                'success' => true,
                'price' => $product->price, // Replace 'price' with the actual column name in your products table
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Product not found',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $purchaseInvoice = PurchaseInvoice::findOrFail($id);
            $purchaseInvoice->purchaseInvoiceItems()->delete();
            $purchaseInvoice->delete();

            return redirect()->route('purchases.index')->with('success', 'Purchase Invoice Deleted Successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
}