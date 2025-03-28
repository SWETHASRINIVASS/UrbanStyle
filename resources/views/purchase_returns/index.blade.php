<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\purchase_returns\index.blade.php -->
@extends('layouts.app')

@section('title', 'Purchase Returns')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Purchase Returns</h1>
        <a href="{{ route('purchase_returns.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">
             New Return
        </a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('purchase_returns.index') }}" class="mb-4">
        <div class="flex items-center">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search by Invoice No" 
                class="form-control border p-2 rounded w-1/3"
            >
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded ml-2">
                Search
            </button>
        </div>
    </form>

    <!-- Purchase Returns Table -->
    <table class="w-full border-collapse shadow-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Invoice Number</th>
                <th class="p-2 border">Supplier</th>
                <th class="p-2 border">Return Reason</th>
                <th class="p-2 border">Return Amount</th>
                <th class="p-2 border">Return Date</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchaseReturns as $purchaseReturn)
                <tr>
                    <td class="p-2 border">{{ $purchaseReturn->id }}</td>
                    <td class="p-2 border">{{ $purchaseReturn->purchaseInvoice->invoice_number ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $purchaseReturn->supplier->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $purchaseReturn->return_reason }}</td>
                    <td class="p-2 border">₹{{ number_format($purchaseReturn->return_amount, 2) }}</td>
                    <td class="p-2 border">{{ $purchaseReturn->return_date }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('purchase_returns.show', $purchaseReturn->id) }}" >
                            👁️
                        </a>
                        <a href="{{ route('purchase_returns.edit', $purchaseReturn->id) }}" >
                            📝
                        </a>
                        <form action="{{ route('purchase_returns.destroy', $purchaseReturn->id) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  onclick="return confirm('Are you sure you want to delete this purchase return?')">
                                🗑️
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-2 border text-center">No purchase returns found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $purchaseReturns->links() }}
    </div>
</div>
@endsection