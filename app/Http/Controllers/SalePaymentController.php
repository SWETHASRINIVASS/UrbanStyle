<?php

namespace App\Http\Controllers;

use App\Models\SalePayment;
use App\Models\SaleInvoice;
use App\Models\Customer;
use Illuminate\Http\Request;

class SalePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SalePayment::with('saleInvoice');

        // Search functionality (optional: search by invoice number or payment method)
        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('saleInvoice', function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%');
            })->orWhere('payment_method', 'like', '%' . $request->search . '%');
        }

        $salePayments = $query->orderBy('date', 'desc')->paginate(10);

        return view('sale_payments.index', compact('salePayments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $saleInvoices = SaleInvoice::with('customer')->get(); // Fetch all sale invoices
        $customers = Customer::all();
        
        return view('sale_payments.create', compact('saleInvoices', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sale_invoice_id' => 'required|exists:sale_invoices,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'payment_method' => 'required|string',
            'balance_due' => 'nullable|numeric|min:0',
            'status' => 'required|string',
        ]);

        SalePayment::create($validatedData);

        return redirect()->route('sale_payments.index')->with('success', 'Sale payment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalePayment $salePayment)
    {
        return view('sale_payments.show', compact('salePayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalePayment $salePayment)
    {
        $saleInvoices = SaleInvoice::all(); // Fetch all sale invoices
        $customers = Customer::all();
        return view('sale_payments.edit', compact('salePayment', 'saleInvoices', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalePayment $salePayment)
    {
        $validatedData = $request->validate([
            'sale_invoice_id' => 'required|exists:sale_invoices,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'payment_method' => 'required|string',
            'balance_due' => 'nullable|numeric|min:0',
            'status' => 'required|string',
        ]);

        $salePayment->update($validatedData);

        return redirect()->route('sale_payments.index')->with('success', 'Sale payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalePayment $salePayment)
    {
        $salePayment->delete();

        return redirect()->route('sale_payments.index')->with('success', 'Sale payment deleted successfully');
    }
}
