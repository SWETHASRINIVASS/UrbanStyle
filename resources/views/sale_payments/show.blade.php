<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\sale_payments\show.blade.php -->
@extends('layouts.app')

@section('title', 'Sale Payment Details')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Sale Payment Details</h1>

    <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
        <tbody>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Invoice Number</th>
                <td class="px-4 py-2">{{ $salePayment->saleInvoice->invoice_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Customer</th>
                <td class="px-4 py-2">{{ $salePayment->saleInvoice->customer->name ?? 'N/A' }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Amount</th>
                <td class="px-4 py-2">{{ number_format($salePayment->amount, 2) }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Payment Method</th>
                <td class="px-4 py-2">{{ $salePayment->payment_method }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Payment Date</th>
                <td class="px-4 py-2">{{ $salePayment->date }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Status</th>
                <td class="px-4 py-2">{{ $salePayment->status }}</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('sale_payments.edit', $salePayment->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
        <a href="{{ route('sale_payments.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection