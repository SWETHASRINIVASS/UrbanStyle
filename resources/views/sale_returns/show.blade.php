<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\sale_returns\show.blade.php -->
@extends('layouts.app')

@section('title', 'Sale Return Details')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Sale Return Details</h1>

    <!-- General Information -->
    <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
        <tbody>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Return ID</th>
                <td class="px-4 py-2">{{ $saleReturn->id }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Invoice Number</th>
                <td class="px-4 py-2">{{ $saleReturn->saleInvoice->invoice_number ?? 'N/A' }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Customer</th>
                <td class="px-4 py-2">{{ $saleReturn->customer->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Return Reason</th>
                <td class="px-4 py-2">{{ $saleReturn->return_reason }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Refund Amount</th>
                <td class="px-4 py-2">₹{{ number_format($saleReturn->refund_amount, 2) }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Refund Date</th>
                <td class="px-4 py-2">{{ $saleReturn->refund_date }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Return Items -->
    <h2 class="text-xl font-bold mt-4">Return Items</h2>
    <table class="w-full border-collapse shadow-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Product</th>
                <th class="p-2 border">Quantity</th>
                <th class="p-2 border">Unit Price</th>
                <th class="p-2 border">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saleReturn->saleReturnItems as $item)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $item->product->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $item->quantity }}</td>
                    <td class="p-2 border">₹{{ number_format($item->price, 2) }}</td>
                    <td class="p-2 border">₹{{ number_format($item->total_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Action Buttons -->
    <div class="mt-6">
        <a href="{{ route('sale_returns.edit', $saleReturn->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
        <a href="{{ route('sale_returns.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection