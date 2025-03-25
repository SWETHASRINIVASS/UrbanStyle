<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use App\Models\PurchaseInvoice;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    /**
     * Display a listing of the purchase returns.
     */
    public function index(Request $request)
    {
        $query = PurchaseReturn::with('supplier', 'purchaseInvoice');

        if ($request->has('search') && !empty($request->search)) {
            $query->wherehas('purchaseInvoice', function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%');
            });
        }
        $purchaseReturns = $query->orderBy('return_date', 'desc')->paginate(10);
        
        return view('purchase_returns.index', compact('purchaseReturns'));
    }

    /**
     * Show the form for creating a new purchase return.
     */
    public function create()
    {
        $purchaseInvoices = PurchaseInvoice::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        

        return view('purchase_returns.create', compact('purchaseInvoices', 'suppliers', 'products'));
    }

    /**
     * Store a newly created purchase return in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'purchase_invoice_id' => 'required|exists:purchase_invoices,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'return_reason' => 'required|string|max:255',
            'return_date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            
        ]);

        // Create the purchase return
        $purchaseReturn = PurchaseReturn::create([
            'purchase_invoice_id' => $request->purchase_invoice_id,
            'supplier_id' => $request->supplier_id,
            'return_reason' => $request->return_reason,
            'return_amount' => collect($request->items)->sum(function ($item) {
                 return $item['quantity'] * $item['price'];
            }),
            'return_date' => $request->return_date,
        ]);

        // Create the purchase return items
        foreach ($request->items as $item) {
            PurchaseReturnItem::create([
                'purchase_return_id' => $purchaseReturn->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_amount' => $item['total_amount'] ?? ($item['quantity'] * $item['price']),
                'return_date' => $request->return_date,
            ]);
        }

        return redirect()->route('purchase_returns.index')->with('success', 'Purchase return created successfully.');
    }

    /**
     * Display the specified purchase return.
     */
    public function show($id)
    {
        $purchaseReturn = PurchaseReturn::with('supplier', 'purchaseInvoice', 'purchaseReturnItems.product')->findOrFail($id);
        return view('purchase_returns.show', compact('purchaseReturn'));
    }

    /**
     * Show the form for editing the specified purchase return.
     */
    public function edit($id)
    {
        $purchaseReturn = PurchaseReturn::with('purchaseReturnItems.product')->findOrFail($id);
        $purchaseInvoices = PurchaseInvoice::all();
        $suppliers = Supplier::all();
        $products = Product::all();

        $items = $purchaseReturn->purchaseReturnItems->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total_amount' => $item->total_amount,
            ];
        });
        

        return view('purchase_returns.edit', compact('purchaseReturn', 'purchaseInvoices', 'suppliers', 'products','items'));
    }

    /**
     * Update the specified purchase return in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'purchase_invoice_id' => 'required|exists:purchase_invoices,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'return_reason' => 'required|string|max:255',
            'return_date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            
        ]);

        // Update the purchase return
        $purchaseReturn = PurchaseReturn::findOrFail($id);
        $purchaseReturn->update([
            'purchase_invoice_id' => $request->purchase_invoice_id,
            'supplier_id' => $request->supplier_id,
            'return_reason' => $request->return_reason,
            'return_amount' => collect($request->items)->sum(function ($item) {
                 return $item['quantity'] * $item['price'];
            }),            
            'return_date' => $request->return_date,
        ]);

        // Delete existing items and recreate them
        $purchaseReturn->purchaseReturnItems()->delete();

        foreach ($request->items as $item) {
            PurchaseReturnItem::create([
                'purchase_return_id' => $purchaseReturn->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
        'total_amount' => $item['total_amount'] ?? ($item['quantity'] * $item['price']),
                'return_date' => $request->return_date,
            ]);
        }

        return redirect()->route('purchase_returns.index')->with('success', 'Purchase return updated successfully.');
    }

    /**
     * Remove the specified purchase return from storage.
     */
    public function destroy($id)
    {
        $purchaseReturn = PurchaseReturn::findOrFail($id);
        $purchaseReturn->delete();

        return redirect()->route('purchase_returns.index')->with('success', 'Purchase return deleted successfully.');
    }
}