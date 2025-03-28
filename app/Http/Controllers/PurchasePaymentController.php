<?php

namespace App\Http\Controllers;

use App\Models\PurchasePayment;
use App\Models\PurchaseInvoice;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PurchasePayment::with('purchaseInvoice');

        // Search functionality (optional: search by invoice number or payment method)
        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('purchaseInvoice', function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%');
            })->orWhere('payment_method', 'like', '%' . $request->search . '%');
        }

        $purchasePayments = $query->orderBy('date', 'desc')->paginate(10);

        return view('purchase_payments.index', compact('purchasePayments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $purchaseInvoices = PurchaseInvoice::with('supplier')->get(); // Fetch all purchase invoices
        $suppliers = Supplier::all();
        return view('purchase_payments.create', compact('purchaseInvoices', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'purchase_invoice_id' => 'required|exists:purchase_invoices,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'payment_method' => 'required|string',
            'balance_due' => 'nullable|numeric|min:0',
            'status' => 'required|string',
        ]);

        PurchasePayment::create($validatedData);

        return redirect()->route('purchase_payments.index')->with('success', 'Purchase payment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchasePayment $purchasePayment)
    {
        return view('purchase_payments.show', compact('purchasePayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchasePayment $purchasePayment)
    {
        $purchaseInvoices = PurchaseInvoice::all(); // Fetch all purchase invoices
        $suppliers = Supplier::all();
        return view('purchase_payments.edit', compact('purchasePayment', 'purchaseInvoices', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchasePayment $purchasePayment)
    {
        $validatedData = $request->validate([
            'purchase_invoice_id' => 'required|exists:purchase_invoices,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'payment_method' => 'required|string',
            'balance_due' => 'nullable|numeric|min:0',
            'status' => 'required|string',
        ]);

        $purchasePayment->update($validatedData);

        return redirect()->route('purchase_payments.index')->with('success', 'Purchase payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchasePayment $purchasePayment)
    {
        $purchasePayment->delete();

        return redirect()->route('purchase_payments.index')->with('success', 'Purchase payment deleted successfully');
    }
}
