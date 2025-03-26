<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use App\Models\SalePayment;
use App\Models\SaleReturn;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Tax;
use App\Services\InvoicePdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SaleInvoice::with(['customer', 'saleInvoiceItems']);

        // Search functionality
        if ($request->filled('search')) {
            $query->where('invoice_number', 'like', '%' . $request->search . '%');
        }

        $saleInvoices = $query->latest()->paginate(10);
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
        try {
            $validatedData = $request->validate([
                'customer_id' => 'nullable|exists:customers,id',
                'invoice_date' => 'required|date',
                'round_off' => 'nullable|numeric',
                'global_discount' => 'nullable|numeric',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|numeric|min:1',
                'items.*.price' => 'required|numeric|min:0',
                'items.*.discount' => 'nullable|numeric|min:0',
                'items.*.tax_rate' => 'nullable|numeric|min:0',
            ]);

            DB::beginTransaction();

            // Generate a unique invoice number
            $lastInvoice = SaleInvoice::latest()->first();
            $newInvoiceNumber = $lastInvoice ? 'INV-' . str_pad($lastInvoice->id + 1, 6, '0', STR_PAD_LEFT) : 'INV-000001';

            // Create Sale Invoice
            $saleInvoice = SaleInvoice::create([
                'invoice_number' => $newInvoiceNumber,
                'customer_id' => $validatedData['customer_id'],
                'invoice_date' => $validatedData['invoice_date'],
                'round_off' => $validatedData['round_off'] ?? 0,
                'global_discount' => $validatedData['global_discount'] ?? 0,
                'total_amount' => 0, // Temporary, will be updated later
            ]);

            $totalAmount = 0;

            // Create Sale Invoice Items
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
                    'discount' => $item['discount'] ?? 0,
                    'tax_rate' => $item['tax_rate'] ?? 0,
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
     * Show the specified invoice.
     */
    public function show(string $id)
    {
        $saleInvoice = SaleInvoice::with(['customer', 'saleInvoiceItems.product'])->findOrFail($id);
        return view('sales.show', compact('saleInvoice'));
    }

    /**
     * Show the form for editing the specified invoice.
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
     * Update the specified invoice.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $saleInvoice = SaleInvoice::findOrFail($id);

            // Update sale invoice
            $saleInvoice->update([
                'customer_id' => $request->customer_id,
                'invoice_date' => $request->invoice_date,
                'round_off' => $request->round_off ?? 0,
                'global_discount' => $request->global_discount ?? 0,
            ]);

            $totalAmount = 0;
            $saleInvoice->saleInvoiceItems()->delete();

            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discountAmount = ($subtotal * ($item['discount'] ?? 0)) / 100;
                $taxAmount = (($subtotal - $discountAmount) * $item['tax_rate']) / 100;
                $totalPrice = $subtotal - $discountAmount + $taxAmount;

                SaleInvoiceItem::create([
                    'sale_invoice_id' => $saleInvoice->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'tax_rate' => $item['tax_rate'] ?? 0,
                    'discount' => $item['discount'] ?? 0,
                    'total_amount' => $totalPrice,
                ]);

                $totalAmount += $totalPrice;
            }

            // Update total amount
            $saleInvoice->update([
                'total_amount' => round($totalAmount),
            ]);

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Sale invoice updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    /**
     * Generate PDF for the specified resource.
     */
    public function generatePdf($id)
    {
    $invoice = SaleInvoice::with('saleInvoiceitems.product', 'customer')->findOrFail($id);

    $invoicesPath = storage_path('app/invoices');
    if (!File::exists($invoicesPath)) {
        File::makeDirectory($invoicesPath, 0755, true);
    }
    $pdf = new InvoicePdf($invoice, 'sale');
    $pdfPath = $pdf->generatePdf();

    return Response::download($pdfPath, "sale_invoice_{$invoice->invoice_number}.pdf");
    }

    /**
     * Remove the specified invoice from storage.
     */
    public function destroy(string $id)
    {
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
