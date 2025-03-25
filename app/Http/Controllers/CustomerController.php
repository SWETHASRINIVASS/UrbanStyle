<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::query();
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $customers = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view("Customers.index", compact("customers"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view("customers.create", compact("customers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers',
            'email' => 'nullable|email|unique:customers',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'pin_code' => 'nullable|string'

        ]);
        $customer = Customer::create($validatedData);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::with('saleInvoices')->find($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone,' . $id,
            'email' => 'nullable|email|unique:customers,email,' . $id,
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'pin_code' => 'nullable|string'
        ]);
        $customer->update($validatedData);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->route('customers.index')->with('error', 'Customer not found');
        }
        if ($customer->saleInvoices()->count() > 0) {
            return redirect()->route('customers.index')->with('error', 'Customer cannot be deleted as they have invoices');
        }
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
