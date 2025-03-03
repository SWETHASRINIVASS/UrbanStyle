<?php

namespace App\Http\Controllers;

use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use App\Models\SalePayment;
use App\Models\SaleReturn;
use App\Models\SaleReturnItem;
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
        $saleInvoices = SaleInvoice::with(['SaleInvoiceItems', 'SalePayments', 'SaleReturns.SaleReturnItems'])->get();
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
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax_price' => 'nullable|numeric',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'phone' => 'nullable|string'
        ]);
        $saleInvoice = SaleInvoice::create($validatedData);
        // Handle items
        if ($request->has('items')) {
            foreach ($request->items as $item) {
                $saleInvoice->saleInvoiceItems()->create($item);
            }
        }

        // Handle payments
        if ($request->has('payments')) {
            foreach ($request->payments as $payment) {
                $saleInvoice->salePayments()->create($payment);
            }
        }

        // Handle returns
        if ($request->has('returns')) {
            foreach ($request->returns as $return) {
                $saleReturn = $saleInvoice->saleReturns()->create($return);
                if (isset($return['items'])) {
                    foreach ($return['items'] as $returnItem) {
                        $saleReturn->saleReturnItems()->create($returnItem);
                    }
                }
            }
        }
        return redirect()->route('sales.index')->with('success', 'Sale invoice created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $saleInvoice = SaleInvoice::with(['customer', 'saleInvoiceItems', 'salePayments','saleReturns.saleReturnItems'])->find($id);
        if (!$saleInvoice) {
            return redirect()->route('sales.index')->with('error', 'Sale Invoice not found');
        }
        return view('sales.show', compact('saleInvoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $saleInvoice = SaleInvoice::find($id);
        if (!$saleInvoice) {
            return redirect()->route('sales.index')->with('error', 'Sale Invoice not found');
        }
        $customers = Customer::all();
        $products = Product::all();
        return view('sales.edit', compact('saleInvoice','customers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $saleInvoice = SaleInvoice::find($id);
        if (!$saleInvoice) {
            return redirect()->route('sales.index')->with('error', 'Sale Invoice not found');
        }
        $validatedData = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'invoice_number' => 'required|string|unique:sale_invoices,invoice_number,' . $id,
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax_price' => 'nullable|numeric',
            'round_off' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'phone' => 'nullable|string'
        ]);
        $saleInvoice->update($validatedData);
        // Handle items
        $saleInvoice->saleInvoiceItems()->delete();
        if ($request->has('items')) {
            foreach ($request->items as $item) {
                $saleInvoice->saleInvoiceItem()->create($item);
            }
        }

        // Handle payments
        $saleInvoice->salePayments()->delete();
        if ($request->has('payments')) {
            foreach ($request->payments as $payment) {
                $saleInvoice->salePayment()->create($payment);
            }
        }

        // Handle returns
        $saleInvoice->saleReturns()->delete();
        if ($request->has('returns')) {
            foreach ($request->returns as $return) {
                $saleReturn = $saleInvoice->saleReturn()->create($return);
                if (isset($return['items'])) {
                    foreach ($return['items'] as $returnItem) {
                        $saleReturn->saleReturnItem()->create($returnItem);
                    }
                }
            }
        }
        return redirect()->route('sales.index')->with('success', 'Sale invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saleInvoice = SaleInvoice::find($id);
        if (!$saleInvoice) {
            return redirect()->route('sales.index')->with('error', 'Sale Invoice not found');
        }
        $saleInvoice->delete();
        return redirect()->route('sales.index')->with('success', 'Sale invoice deleted successfully');
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
        return redirect()->route('sales.show', $validatedData['sale_invoice_id'])->with('success', 'Sale payment added successfully');
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
        return redirect()->route('sales.show', $validatedData['sale_invoice_id'])->with('success', 'Sale return added successfully');
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
        return redirect()->route('sales.show', $validatedData['sale_return_id'])->with('success', 'Sale return item added successfully');
    }
}
