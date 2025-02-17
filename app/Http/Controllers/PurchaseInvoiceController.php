<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInvoice;
use App\Models\PurchasePayment;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PurchaseInvoice::with(['supplier', 'purchaseInvoiceItems', 'purchasePayments', 'purchaseReturn.purchaseReturnItems'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_number' => 'required|string|unique:purchase_invoices',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax_price' => 'nullable|numeric',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'date' => 'required|date',
            'payment_mode' => 'required|string'

        ]);

        $purchaseInvoice = PurchaseInvoice::create($validatedData);
        return response()->json(['message' => 'Purchase Invoice created successfully', 'data' => $purchaseInvoice], 201);
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
        return response()->json(['message' => 'Purchase Payment added successfully','data' => $purchasePayment], 201);

    }

    // store purchase return
    public function storeReturn(Request $request)
    {
        $validatedData = $request->validate([
            'purchase_invoice_id' => 'required|exists:purchase_invoices,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'return_reason' => 'required|string',
            'retuen_amount' => 'required|numeric',
            'return_date' => 'required|date'
        ]);

        $purchaseReturn = PurchaseReturn::create($validatedData);
        return response()->json(['message' => 'purchase return added successfully ', 'data' => $purchaseReturn], 201);
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
        return response()->json(['message' => 'Purchase Return Item added successfully', 'data' => $purchaseReturnItem], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseInvoice = PurchaseInvoice::with(['supplier', 'purchaseInvoiceItems', 'purchasePayments', 'purchaseReturn.purchaseReturnItems'])->find($id);
        if (!$purchaseInvoice) {
            return response()->json(['message' => 'Purchase Invoice not found'], 404);
        }
        return response()->json($purchaseInvoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}