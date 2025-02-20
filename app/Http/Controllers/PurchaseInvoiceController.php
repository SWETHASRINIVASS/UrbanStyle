<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInvoice;
use App\Models\PurchasePayment;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseInvoices = PurchaseInvoice::with(['supplier', 'purchaseInvoiceItems', 'purchasePayments', 'purchaseReturn.purchaseReturnItems'])->get();
        return view('purchases.index', compact('purchaseInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('purchases.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_number' => 'required|string|unique:purchase_invoices',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $purchaseInvoice = PurchaseInvoice::create($validatedData);
        return redirect()->route('purchases.index')->with('success', 'Purchase Invoice created successfully');
    }

    // store a purchase payment
    public function storePayment(Request $request)
    {
        $validatedData = $request->validate([
            'purchase_invoice_id' => 'required|exists:purchase_invoices,id',
            'amount' => 'required|numeric',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'date' => 'required|date',
            'payment_method' => 'required|string',
            'balance_due' => 'nullable|numeric',
            'status' => 'required|string'
        ]);

        $purchasePayment = PurchasePayment::create($validatedData);
        return redirect()->route('purchases.index')->with('success', 'Purchase Payment added successfully');
    }

    // store purchase return
    public function storeReturn(Request $request)
    {
        $validatedData = $request->validate([
            'purchase_invoice_id' => 'required|exists:purchase_invoices,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'return_reason' => 'required|string',
            'return_amount' => 'required|numeric',
            'return_date' => 'required|date'
        ]);

        $purchaseReturn = PurchaseReturn::create($validatedData);
        return redirect()->route('purchases.index')->with('success', 'Purchase Return added successfully');
    }

    // store purchase return item
    public function storeReturnItem(Request $request)
    {
        $validatedData = $request->validate([
            'purchase_return_id' => 'required|exists:purchase_returns,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'purchase_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax_rate' => 'nullable|numeric',
            'tax_price' => 'nullable|numeric',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'return_date' => 'required|date'
        ]);

        $purchaseReturnItem = PurchaseReturnItem::create($validatedData);
        return redirect()->route('purchases.index')->with('success', 'Purchase Return Item added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseInvoice = PurchaseInvoice::with(['supplier', 'purchaseInvoiceItems', 'purchasePayments', 'purchaseReturn.purchaseReturnItems'])->find($id);
        if (!$purchaseInvoice) {
            return redirect()->route('purchases.index')->with('error', 'Purchase Invoice not found');
        }
        return view('purchases.show', compact('purchaseInvoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchaseInvoice = PurchaseInvoice::find($id);
        if (!$purchaseInvoice) {
            return redirect()->route('purchases.index')->with('error', 'Purchase Invoice not found');
        }
        $suppliers = Supplier::all();
        return view('purchases.edit', compact('purchaseInvoice', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $purchaseInvoice = PurchaseInvoice::find($id);
        if (!$purchaseInvoice) {
            return redirect()->route('purchases.index')->with('error', 'Purchase Invoice not found');
        }

        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_number' => 'required|string|unique:purchase_invoices,invoice_number,' . $id,
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $purchaseInvoice->update($validatedData);
        return redirect()->route('purchases.index')->with('success', 'Purchase Invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchaseInvoice = PurchaseInvoice::find($id);
        if (!$purchaseInvoice) {
            return redirect()->route('purchases.index')->with('error', 'Purchase Invoice not found');
        }

        $purchaseInvoice->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase Invoice deleted successfully');
    }
}