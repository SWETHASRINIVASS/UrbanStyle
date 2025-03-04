<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saleInvoices = SaleInvoice::with(['customer', 'saleInvoiceItems.product'])->get();
        return view('sales.index', compact('saleInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('sales.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'invoice_number' => 'required|string|unique:sale_invoices',
            'invoice_date' => 'required|date',
            'tax_rate' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'tax_amount' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric',
        ]);

        $saleInvoice = SaleInvoice::create($validatedData);

        // Handle items
        foreach ($request->items as $item) {
            $item['subtotal'] = $item['quantity'] * $item['price'];
            $saleInvoice->saleInvoiceItems()->create($item);
        }

        return redirect()->route('sales.index')->with('success', 'Sale invoice created successfully');
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
        return view('sales.edit', compact('saleInvoice', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $saleInvoice = SaleInvoice::findOrFail($id);

        $validatedData = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'invoice_number' => 'required|string|unique:sale_invoices,invoice_number,' . $id,
            'invoice_date' => 'required|date',
            'tax_rate' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'tax_amount' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric',
        ]);

        $saleInvoice->update($validatedData);

        // Handle items
        $saleInvoice->saleInvoiceItems()->delete();
        foreach ($request->items as $item) {
            $item['subtotal'] = $item['quantity'] * $item['price'];
            $saleInvoice->saleInvoiceItems()->create($item);
        }

        return redirect()->route('sales.index')->with('success', 'Sale invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saleInvoice = SaleInvoice::findOrFail($id);
        $saleInvoice->delete();
        return redirect()->route('sales.index')->with('success', 'Sale invoice deleted successfully');
    }
}