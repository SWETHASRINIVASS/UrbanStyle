<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/sales/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Sale Invoice Details</h1>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $saleInvoice->id }}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{ $saleInvoice->customer->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Invoice Number</th>
                    <td>{{ $saleInvoice->invoice_number }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $saleInvoice->date }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>{{ $saleInvoice->amount }}</td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td>{{ $saleInvoice->discount }}</td>
                </tr>
                <tr>
                    <th>Tax Price</th>
                    <td>{{ $saleInvoice->tax_price }}</td>
                </tr>
                <tr>
                    <th>Round Off</th>
                    <td>{{ $saleInvoice->round_off }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>{{ $saleInvoice->total_amount }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $saleInvoice->status }}</td>
                </tr>
                <tr>
                    <th>Customer Phone</th>
                    <td>{{ $saleInvoice->customer_phone }}</td>
                </tr>
            </table>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection