<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\sales\index.blade.php -->
@extends('layouts.app')

@section('title', 'Sales Invoices')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Sales Invoices</h1>
        <a href="{{ route('sales.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New Invoice</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('sales.index') }}" class="mb-4">
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
                <th class="p-2 border">Customer</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Total Amount</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($saleInvoices as $saleInvoice)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $saleInvoice->id }}</td>
                    <td class="p-2 border">{{ $saleInvoice->invoice_number }}</td>
                    <td class="p-2 border">{{ $saleInvoice->customer->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $saleInvoice->invoice_date }}</td>
                    <td class="p-2 border">{{ number_format($saleInvoice->total_amount, 2) }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('sales.show', $saleInvoice->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('sales.edit', $saleInvoice->id) }}" class="text-green-500 ml-2">Edit</a>
                        <a href="{{ route('sales.print', $saleInvoice->id) }}" class="text-gray-500 ml-2">Print</a>
                        <form action="{{ route('sales.destroy', $saleInvoice->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-2 border text-center">No invoices found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $saleInvoices->links() }}
    </div>
</div>
@endsection