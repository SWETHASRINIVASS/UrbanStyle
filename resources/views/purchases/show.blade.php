<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\purchases\show.blade.php -->
@extends('layouts.app')

@section('title', 'Purchase Invoice Details')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Purchase Invoice Details</h1>

    <!-- Invoice Details -->
    <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
        <tbody>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">ID</th>
                <td class="px-4 py-2">{{ $purchaseInvoice->id }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Invoice Number</th>
                <td class="px-4 py-2">{{ $purchaseInvoice->invoice_number }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Supplier</th>
                <td class="px-4 py-2">{{ $purchaseInvoice->supplier->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Invoice Date</th>
                <td class="px-4 py-2">{{ $purchaseInvoice->invoice_date }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Total Amount</th>
                <td class="px-4 py-2">{{ number_format($purchaseInvoice->total_amount, 2) }}</td>
            </tr>
            {{-- <tr>
                <th class="px-4 py-2 text-left">Round Off</th>
                <td class="px-4 py-2">{{ number_format($purchaseInvoice->round_off, 2) }}</td>
            </tr> --}}
            {{-- <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Status</th>
                <td class="px-4 py-2">{{ $purchaseInvoice->status ?? 'N/A' }}</td>
            </tr> --}}
        </tbody>
    </table>

    <!-- Invoice Items -->
    <h2 class="text-xl font-bold mt-4">Invoice Details</h2>
    <table class="w-full border-collapse shadow-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Product</th>
                <th class="p-2 border">Quantity</th>
                <th class="p-2 border">Unit Price</th>
                <th class="p-2 border">Discount (%)</th>
                <th class="p-2 border">Tax rate (%)</th>
                <th class="p-2 border">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseInvoice->purchaseInvoiceItems as $item)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $item->product->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $item->quantity }}</td>
                    <td class="p-2 border">{{ number_format($item->price, 2) }}</td>
                    <td class="p-2 border">{{ $item->discount ?? 0 }}%</td>
                    <td class="p-2 border">{{ $item->tax_rate ?? 0 }}%</td>
                    <td class="p-2 border">
                        {{ number_format(($item->quantity * $item->price) - (($item->quantity * $item->price) * ($item->discount / 100)) + (($item->quantity * $item->price) * ($item->tax_rate / 100)), 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Action Buttons -->
    <div class="mt-6">
        <a href="{{ route('purchases.edit', $purchaseInvoice->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
        <a href="{{ route('purchases.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection