@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font bold mb-4">Purchase Invoice Details</h1>
            <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
                <tbody>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">ID</th>
                    <td class="px-4 py-2">{{ $purchaseInvoice->id }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left">Supplier</th>
                    <td class="px-4 py-2">{{ $purchaseInvoice->supplier->name }}</td>
                </tr>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">Invoice Number</th>
                    <td class="px-4 py-2">{{ $purchaseInvoice->invoice_number }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left">Invoice Date</th>
                    <td class="px-4 py-2">{{ $purchaseInvoice->invoice_date }}</td>
                </tr>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">Total Amount</th>
                    <td class="px-4 py-2">{{ $purchaseInvoice->total_amount }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left">Paid Amount</th>
                    <td class="px-4 py-2">{{ $purchaseInvoice->paid_amount }}</td>
                </tr>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left">Due Amount</th>
                    <td class="px-4 py-2">{{ $purchaseInvoice->due_amount }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left">Status</th>
                    <td class="px-4 py-2">{{ $purchaseInvoice->status }}</td>
                </tr>
                </tbody>
            </table>
            <br>
            <a href="{{ route('purchases.edit', $purchaseInvoice->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('purchases.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>
</div>
@endsection