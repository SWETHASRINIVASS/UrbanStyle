<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use App\Models\SalePayment;
use App\Models\saleReturn;
use App\Models\SaleReturnItem;
use Illuminate\Http\Request;

class SaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(SaleInvoice::with(['customer','saleInvoiceItems','salePayments','saleReturn.saleReturnItems'])->get());

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
            'customer_id' => 'nullable|exists:customers,id',
            'invoice_no' => 'required|string|unique:sale_invoices',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax_price' => 'nullable|numeric',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'customer_phone' => 'nullable|string'
        ]);
        $saleInvoice = SaleInvoice::create($validatedData);
        return response()->json(['message' => 'Sale invoice created successfully', 'data' => $saleInvoice], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $saleInvoice = SaleInvoice::with(['customer', 'saleInvoiceItems', 'salePayments','saleReturn.saleReturnItems'])->find($id);
        if (!$saleInvoice) {
            return response()->json(['message' => 'Sale Invoice not found'], 404);
        }
        return response()->json($saleInvoice);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // store sale payment
    public function storePayment(Request $request)
    {
        $validatedData = $request->validate([
            'sale_invoice_id' => 'required|exists:sale_invoices,id',
            'amount' => 'required|numeric',
            'round_off' => 'nullable|numeric',
            'total-amount' => 'required|numeric',
            'date' => 'required|date',
            'payment_method' => 'required|string',
            'balance_due' => 'nullable|numeric',
            'status' => 'required|string'

        ]);
        $salePayment = SalePayment::create($validatedData);
        return response()->json(['message' => 'Sale payment added successfully', 'data' => $salePayment], 201);
    }
    // store sale return
    public function storeReturn(Request $request)
    {
        $validatedData = $request->validate([
            'sale_invoice_id' => 'required|exists:sale_invoices,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'return_reason' => 'required|string',
            'refund_amount' => 'required|numeric',
            'refund_date' => 'required|date',

        ]);
        $saleReturn = SaleReturn::create($validatedData);
        return response()->json(['message' => 'Sale return added successfully' , 'data' =>$saleReturn],201);

    }
    // store sale return item
    public function storeReturnItem(Request $request)
    {
        $validatedData = $request->validate([
            'sale_return_id' => 'required|exists:sale_returns,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'sale_price' => 'required|numeric',
            'tax_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'return_amount' => 'required|numeric'
        ]);

        $saleReturnItem = SalereturnItem::create($validatedData);
        return response()->json(['message' => 'Sale return item added successfully', 'data' => $saleReturnItem], 201);

    }
}
