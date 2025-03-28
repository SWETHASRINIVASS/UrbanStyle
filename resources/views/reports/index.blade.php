@extends('layouts.app')

@section('title', 'Reports Dashboard')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">📊 Reports Dashboard</h1>
        <p class="text-muted">Access detailed reports for sales, purchases, stock, and financials.</p>
    </div>

    <div class="row g-4">
        <!-- Sales Reports -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-primary">
                        <i class="bi bi-graph-up fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold text-primary">Sales Reports</h5>
                    <p class="card-text text-muted">Track sales by customer, product, and time period.</p>
                    <a href="{{ route('reports.sales') }}" class="btn btn-primary w-100">View Sales Reports</a>
                </div>
            </div>
        </div>

        <!-- Purchase Reports -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-warning">
                        <i class="bi bi-cart-check fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold text-warning">Purchase Reports</h5>
                    <p class="card-text text-muted">Analyze purchases by supplier and pending payments.</p>
                    <a href="{{ route('reports.purchases') }}" class="btn btn-warning w-100">View Purchase Reports</a>
                </div>
            </div>
        </div>

        <!-- Stock Reports -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-success">
                        <i class="bi bi-box-seam fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold text-success">Stock Reports</h5>
                    <p class="card-text text-muted">Monitor low stock alerts and stock movements.</p>
                    <a href="{{ route('reports.stock') }}" class="btn btn-success w-100">View Stock Reports</a>
                </div>
            </div>
        </div>

        <!-- Financial Reports -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-danger">
                        <i class="bi bi-cash-coin fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold text-danger">Financial Reports</h5>
                    <p class="card-text text-muted">Review profit & loss statements and cash flow.</p>
                    <a href="{{ route('reports.financial') }}" class="btn btn-danger w-100">View Financial Reports</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection