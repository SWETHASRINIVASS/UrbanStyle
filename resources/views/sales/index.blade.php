<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/sales/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Sales Invoices</h1>
            <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Add New Sale Invoice</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saleInvoices as $saleInvoice)
                        <tr>
                            <td>{{ $saleInvoice->id }}</td>
                            <td>{{ $saleInvoice->customer->name ?? 'N/A' }}</td>
                            <td>{{ $saleInvoice->invoice_number }}</td>
                            <td>{{ $saleInvoice->date }}</td>
                            <td>{{ $saleInvoice->total_amount }}</td>
                            <td>{{ $saleInvoice->status }}</td>
                            <td>
                                <a href="{{ route('sales.show', $saleInvoice->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('sales.edit', $saleInvoice->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('sales.destroy', $saleInvoice->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection