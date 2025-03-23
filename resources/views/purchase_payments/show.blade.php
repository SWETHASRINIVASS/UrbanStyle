<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\purchase_payments\show.blade.php -->
@extends('layouts.app')

@section('title', 'Purchase Payment Details')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Purchase Payment Details</h1>

    <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
        <tbody>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Invoice Number</th>
                <td class="px-4 py-2">{{ $purchasePayment->purchaseInvoice->invoice_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Amount</th>
                <td class="px-4 py-2">{{ number_format($purchasePayment->amount, 2) }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Round Off</th>
                <td class="px-4 py-2">{{ number_format($purchasePayment->round_off, 2) }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Total Amount</th>
                <td class="px-4 py-2">{{ number_format($purchasePayment->total_amount, 2) }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Payment Date</th>
                <td class="px-4 py-2">{{ $purchasePayment->date }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Payment Method</th>
                <td class="px-4 py-2">{{ $purchasePayment->payment_method }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Balance Due</th>
                <td class="px-4 py-2">{{ number_format($purchasePayment->balance_due, 2) }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Status</th>
                <td class="px-4 py-2">{{ $purchasePayment->status }}</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('purchase_payments.edit', $purchasePayment->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
        <a href="{{ route('purchase_payments.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection