<?php

namespace App\Http\Controllers;

use App\Models\SaleReturn;
use App\Models\SaleReturnItem;
use App\Models\SaleInvoice;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class SaleReturnController extends Controller
{
    /**
     * Display a listing of the sale returns.
     */
    public function index(Request $request)
{
    $query = SaleReturn::with('customer', 'saleInvoice');

    // Add search functionality
    if ($request->has('search') && !empty($request->search)) {
        $query->whereHas('saleInvoice', function ($q) use ($request) {
            $q->where('invoice_number', 'like', '%' . $request->search . '%');
        });
    }

    $saleReturns = $query->orderBy('refund_date', 'desc')->paginate(10);

    return view('sale_returns.index', compact('saleReturns'));
}

    /**
     * Show the form for creating a new sale return.
     */
    public function create()
{
    $saleInvoices = SaleInvoice::all(); 
    $customers = Customer::all(); 
    $products = Product::all(); 

    return view('sale_returns.create', compact('saleInvoices', 'customers', 'products'));
}

    /**
     * Store a newly created sale return in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sale_invoice_id' => 'required|exists:sale_invoices,id',
            'customer_id' => 'required|exists:customers,id',
            'return_reason' => 'required|string|max:255',
            'refund_date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Create the sale return
        $saleReturn = SaleReturn::create([
            'sale_invoice_id' => $request->sale_invoice_id,
            'customer_id' => $request->customer_id,
            'return_reason' => $request->return_reason,
            'refund_amount' => collect($request->items)->sum(function ($item) {
                return $item['quantity'] * $item['price'];
            }),
            'refund_date' => $request->refund_date,
        ]);

        // Create the sale return items
        foreach ($request->items as $item) {
            SaleReturnItem::create([
                'sale_return_id' => $saleReturn->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_amount' => $item['quantity'] * $item['price'],
                'return_date' => $request->refund_date,
            ]);
        }

        return redirect()->route('sale_returns.index')->with('success', 'Sale return created successfully.');
    }

    /**
     * Display the specified sale return.
     */
    public function show($id)
    {
        $saleReturn = SaleReturn::with('saleReturnItems.product')->findOrFail($id);
        return view('sale_returns.show', compact('saleReturn'));    

    }

    /**
     * Show the form for editing the specified sale return.
     */
    public function edit($id)
{
    $saleReturn = SaleReturn::with('saleReturnItems.product')->findOrFail($id);
    $saleInvoices = SaleInvoice::all();
    $customers = Customer::all();
    $products = Product::all();

    // Prepare items for Alpine.js
    $items = $saleReturn->saleReturnItems->map(function ($item) {
        return [
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->price,
            'total_amount' => $item->total_amount,
        ];
    });

    return view('sale_returns.edit', compact('saleReturn', 'saleInvoices', 'customers', 'products', 'items'));
}

    /**
     * Update the specified sale return in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'sale_invoice_id' => 'required|exists:sale_invoices,id',
            'customer_id' => 'required|exists:customers,id',
            'return_reason' => 'required|string|max:255',
            'refund_date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Update the sale return
        $saleReturn = SaleReturn::findOrFail($id);
        $saleReturn->update([
            'sale_invoice_id' => $request->sale_invoice_id,
            'customer_id' => $request->customer_id,
            'return_reason' => $request->return_reason,
            'refund_amount' => collect($request->items)->sum(function ($item) {
                return $item['quantity'] * $item['price'];
            }),
            'refund_date' => $request->refund_date,
        ]);

        // Delete existing items and recreate them
        $saleReturn->saleReturnItems()->delete();
        foreach ($request->items as $item) {
            SaleReturnItem::create([
                'sale_return_id' => $saleReturn->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_amount' => $item['quantity'] * $item['price'],
                'return_date' => $request->refund_date,
            ]);
        }

        return redirect()->route('sale_returns.index')->with('success', 'Sale return updated successfully.');
    }

    /**
     * Remove the specified sale return from storage.
     */
    public function destroy($id)
    {
        $saleReturn = SaleReturn::findOrFail($id);
        $saleReturn->delete();

        return redirect()->route('sale_returns.index')->with('success', 'Sale return deleted successfully.');
    }
}