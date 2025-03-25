<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\purchases\index.blade.php -->
@extends('layouts.app')

@section('title', 'Purchases Invoices')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Purchases Invoice</h1>
        <a href="{{ route('purchases.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New Invoice</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('purchases.index') }}" class="mb-4">
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
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Total Amount</th>
                {{-- <th class="p-2 border">Status</th> --}}
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchaseInvoices as $purchaseInvoice)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $purchaseInvoice->id }}</td>
                    <td class="p-2 border">{{ $purchaseInvoice->invoice_number }}</td>
                    <td class="p-2 border">{{ $purchaseInvoice->supplier->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $purchaseInvoice->invoice_date }}</td>
                    <td class="p-2 border">{{ $purchaseInvoice->total_amount }}</td>
                    {{-- <td class="p-2 border">{{ $purchaseInvoice->status }}</td> --}}
                    <td class="p-2 border">
                        <a href="{{ route('purchases.show', $purchaseInvoice->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('purchases.edit', $purchaseInvoice->id) }}" class="text-green-500">Edit</a>
                        <form action="{{ route('purchases.destroy', $purchaseInvoice->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-2 border text-center">No invoices found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- <div class="mt-4">
        {{ $purchaseinvoices->links() }}
    </div> --}}
</div>
@endsection