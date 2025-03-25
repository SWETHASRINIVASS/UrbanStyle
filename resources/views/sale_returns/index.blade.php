<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\sale_returns\index.blade.php -->
@extends('layouts.app')

@section('title', 'Sale Returns')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Sale Returns</h1>
        <a href="{{ route('sale_returns.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">
            New Return
        </a>
    </div>

    <!-- Search Bar -->
    <form action="{{ route('sale_returns.index') }}" method="GET" class="mb-4">
        <div class="flex items-center">
            <input 
            type="text" 
            name="search" 
            placeholder="Search by Invoice No" 
            value="{{ request('search') }}"
            class="form-control border p-2 rounded w-1/3"
            >

            <button type="submit" class="ml-2 bg-gray-800 text-white px-4 py-2 rounded-lg shadow">Search</button>
        </div>
    </form>

    <!-- Sale Returns Table -->
    <table class="w-full border-collapse shadow-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Invoice Number</th>
                <th class="p-2 border">Customer</th>
                <th class="p-2 border">Return Reason</th>
                <th class="p-2 border">Refund Amount</th>
                <th class="p-2 border">Refund Date</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($saleReturns as $saleReturn)
                <tr>
                    <td class="p-2 border">{{ $loop->iteration }}</td>
                    <td class="p-2 border">{{ $saleReturn->saleInvoice->invoice_number ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $saleReturn->customer->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $saleReturn->return_reason }}</td>
                    <td class="p-2 border">₹{{ number_format($saleReturn->refund_amount, 2) }}</td>
                    <td class="p-2 border">{{ $saleReturn->refund_date }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('sale_returns.show', $saleReturn->id) }}" class="text-blue-500 hover:underline">
                            View
                        </a>
                        <a href="{{ route('sale_returns.edit', $saleReturn->id) }}" class="text-green-500 hover:underline ml-2">
                            Edit
                        </a>
                        <form action="{{ route('sale_returns.destroy', $saleReturn->id) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this sale return?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-2 border text-center">No sale returns found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $saleReturns->links() }}
    </div>
</div>
@endsection