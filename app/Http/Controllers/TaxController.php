<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxes = Tax::all();
        return view('taxes.index', compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taxes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tax_name' => 'required|string|max:255',
            'tax_rate' => 'required|numeric'
        ]);

        Tax::create($validatedData);

        return redirect()->route('taxes.index')->with('success', 'Tax created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tax = Tax::findOrFail($id);
        return view('taxes.show', compact('tax'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tax = Tax::findOrFail($id);
        return view('taxes.edit', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'tax_name' => 'required|string|max:255',
            'tax_rate' => 'required|numeric'
        ]);

        $tax = Tax::findOrFail($id);
        $tax->update($validatedData);

        return redirect()->route('taxes.index')->with('success', 'Tax updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();

        return redirect()->route('taxes.index')->with('success', 'Tax deleted successfully');
    }
}
