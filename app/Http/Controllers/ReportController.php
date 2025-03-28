<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\SaleInvoice;
use App\Models\SaleInvoiceItem;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Products;
use App\Models\SalePayment;
use App\Models\PurchasePayment;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the reports.
     */
    public function index()
    {
        $reports = Report::orderBy('report_date', 'desc')->paginate(10);
        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'report_date' => 'required|date',
            'data' => 'nullable|array',
        ]);

        Report::create($validatedData);

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified report.
     */
    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified report in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'report_date' => 'required|date',
            'data' => 'nullable|array',
        ]);

        $report->update($validatedData);

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified report from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}