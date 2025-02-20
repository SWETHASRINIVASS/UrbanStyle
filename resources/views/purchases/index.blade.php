@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Purchases Invoice</h1>
            <a href="{{ route('purchases.create') }}" class="btn btn-primary mb-3">Add New Purchase Invoice</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier</th>
                        <th>Invoice Number</th>
                        <th>Invoice Date</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseInvoices as $purchaseInvoice)
                        <tr>
                            <td>{{ $purchaseInvoice->id }}</td>
                            <td>{{ $purchaseInvoice->supplier->name }}</td>
                            <td>{{ $purchaseInvoice->invoice_number }}</td>
                            <td>{{ $purchaseInvoice->invoice_date }}</td>
                            <td>{{ $purchaseInvoice->total_amount }}</td>
                            <td>{{ $purchaseInvoice->paid_amount }}</td>
                            <td>{{ $purchaseInvoice->due_amount }}</td>
                            <td>{{ $purchaseInvoice->status }}</td>
                            <td>
                                <a href="{{ route('purchases.show', $purchaseInvoice->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('purchases.edit', $purchaseInvoice->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('purchases.destroy', $purchaseInvoice->id) }}" method="POST" style="display:inline-block;">
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