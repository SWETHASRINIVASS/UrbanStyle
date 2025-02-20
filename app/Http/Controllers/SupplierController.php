<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\PurchaseInvoice;
use App\Models\PurchasePayment;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with(['purchaseInvoices.purchasePayments'])->get();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:suppliers',
            'phone' => 'required|string|max:20|unique:suppliers',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'pin_code' => 'nullable|string'
        ]);

        $supplier = Supplier::create($validatedData);
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::with(['purchaseInvoices.purchasePayments'])->find($id);
        if (!$supplier) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier not found');
        }
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier not found');
        }
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier not found');
        }

        $validatedData = $request->validate([
           'name' => 'required|string|max:255|unique:suppliers',
            'phone' => 'required|string|max:20|unique:suppliers',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'pin_code' => 'nullable|string'
        ]);

        $supplier->update($validatedData);
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier not found');
        }

        if ($supplier->purchaseInvoices()->count() > 0) {
            return redirect()->route('suppliers.index')->with('error', 'Cannot delete supplier with existing purchase invoices');
        }

        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
    }
}
