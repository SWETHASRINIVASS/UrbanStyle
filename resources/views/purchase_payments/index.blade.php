<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\purchase_payments\index.blade.php -->
@extends('layouts.app')

@section('title', 'Purchase Payments')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Purchase Payments</h1>
        <a href="{{ route('purchase_payments.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New Payment</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('purchase_payments.index') }}" class="mb-4">
        <div class="flex items-center">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search by Invoice No" 
                class="form-control border p-2 rounded w-1/3"
            >
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded ml-2">Search</button>
        </div>
    </form>

    <table class="w-full border-collapse border border-gray-400">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Invoice Number</th>
                <th class="p-2 border">Supplier</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Payment Method</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchasePayments as $payment)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $payment->id }}</td>
                    <td class="p-2 border">{{ $payment->purchaseInvoice->invoice_number ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $payment->purchaseInvoice->supplier->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ number_format($payment->amount, 2) }}</td>
                    <td class="p-2 border">{{ $payment->payment_method }}</td>
                    <td class="p-2 border">{{ $payment->date }}</td>
                    <td class="p-2 border">{{ $payment->status }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('purchase_payments.show', $payment->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('purchase_payments.edit', $payment->id) }}" class="text-green-500 ml-2">Edit</a>
                        <form action="{{ route('purchase_payments.destroy', $payment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-2 border text-center">No payments found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $purchasePayments->links() }}
    </div>
</div>
@endsection