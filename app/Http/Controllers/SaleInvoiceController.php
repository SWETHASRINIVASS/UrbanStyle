<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use App\Models\SalePayment;
use App\Models\SaleReturn;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SaleInvoice::with(['customer', 'saleInvoiceItems.product']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where('invoice_number', 'like', '%' . $request->search . '%');
        }

        $saleInvoices = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('sales.index', compact('saleInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        $taxes = Tax::all();
        return view('sales.create', compact('customers', 'products', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'invoice_date' => 'required|date',
            'round_off' => 'required|numeric',
            'global_discount' => 'nullable|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric',
            'items.*.discount' => 'required|numeric',
            'items.*.tax_rate' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            // Generate a unique invoice number
            $lastInvoice = SaleInvoice::latest()->first();
            $newInvoiceNumber = $lastInvoice ? 'INV-' . str_pad($lastInvoice->id + 1, 6, '0', STR_PAD_LEFT) : 'INV-000001';
            

            // Create the sale invoice
            $saleInvoice = SaleInvoice::create([
                'invoice_number' => $newInvoiceNumber,
                'customer_id' => $validatedData['customer_id'],
                'invoice_date' => $validatedData['invoice_date'],
                'round_off' => $validatedData['round_off'] ?? 0,
                'global_discount' => $validatedData['global_discount'] ?? 0,
                'total_amount' => 0,
                
            ]);
            $totalAmount = 0;

            // Create sale invoice items
            foreach ($validatedData['items'] as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discountAmount = ($subtotal * $item['discount' ?? 0]) / 100;
                $taxAmount = (($subtotal - $discountAmount) * $item['tax_rate']) / 100;
                $totalPrice = $subtotal - $discountAmount + $taxAmount;

                SaleInvoiceItem::create([
                    'sale_invoice_id' => $saleInvoice->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'] ?? 0,
                    'tax_rate' => $item['tax_rate'],
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
            $saleInvoice->update([
                'total_amount' => $roundedFinalAmount,
                'round_off' => $roundOff,
            ]);

            DB::commit();

            return redirect()->route('sales.index')->with('success', 'Sale invoice created successfully');
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
        $saleInvoice = SaleInvoice::with(['customer', 'saleInvoiceItems.product'])->findOrFail($id);
        return view('sales.show', compact('saleInvoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $saleInvoice = SaleInvoice::with('saleInvoiceItems')->findOrFail($id);
    $customers = Customer::all();
    $products = Product::all();
    $taxes = Tax::all();
    return view('sales.edit', compact('saleInvoice', 'customers', 'products', 'taxes'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $saleInvoice = SaleInvoice::findOrFail($id);

        $validatedData = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'invoice_date' => 'required|date',
            'round_off' => 'required|numeric',
            'global_discount' => 'nullable|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric',
            'items.*.discount' => 'required|numeric',
            'items.*.tax_rate' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $saleInvoice = SaleInvoice::findOrFail($id);

            // Update the sale invoice
            $saleInvoice->update([
                'customer_id' => $validatedData['customer_id'],
                'invoice_date' => $validatedData['invoice_date'],
                'round_off' => $validatedData['round_off'] ?? 0,
                'global_discount' => $validatedData['global_discount'],
            ]);

            $totalAmount = 0;

            // Delete existing items and recreate them
            $saleInvoice->saleInvoiceItems()->delete();

            foreach ($validatedData['items'] as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discountAmount = ($subtotal * ($item['discount'] ?? 0)) / 100;
                $taxAmount = (($subtotal - $discountAmount) * $item['tax_rate']) / 100;
                $totalPrice = $subtotal - $discountAmount + $taxAmount;

                SaleInvoiceItem::create([
                    'sale_invoice_id' => $saleInvoice->id,
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
            $saleInvoice->update([
                'total_amount' => $roundedFinalAmount,
                'round_off' => $roundOff,
            ]);

            DB::commit();

            return redirect()->route('sales.index')->with('success', 'Sale invoice updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saleInvoice = SaleInvoice::findOrFail($id);

        try {
            $saleInvoice = SaleInvoice::findOrFail($id);
            $saleInvoice->saleInvoiceItems()->delete();
            $saleInvoice->delete();

            return redirect()->route('sales.index')->with('success', 'Sale invoice deleted successfully');
        } catch (\Exception $e) {
            
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
}