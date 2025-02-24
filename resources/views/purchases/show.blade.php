@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Purchase Invoice Details</h1>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $purchaseInvoice->id }}</td>
                </tr>
                <tr>
                    <th>Supplier</th>
                    <td>{{ $purchaseInvoice->supplier->name }}</td>
                </tr>
                <tr>
                    <th>Invoice Number</th>
                    <td>{{ $purchaseInvoice->invoice_number }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $purchaseInvoice->invoice_date }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>{{ $purchaseInvoice->amount }}</td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td>{{ $purchaseInvoice->discount }}</td>
                </tr>
                <tr>
                    <th>Tax Price</th>
                    <td>{{ $purchaseInvoice->tax_price }}</td>
                </tr>
                <tr>
                    <th>Round Off</th>
                    <td>{{ $purchaseInvoice->round_off }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>{{ $purchaseInvoice->total_amount }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $purchaseInvoice->status }}</td>
                </tr>
            </table>
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection