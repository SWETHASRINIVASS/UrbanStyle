@extends('layouts.app')

@section('content')
<div class="bg-white p-6 shadow-md rounded-md">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Sales Invoices</h1>
        <a href="{{ route('sales.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New Invoice</a>
    </div>

    <table class="w-full border-collapse shadow-lg">
        <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Customer</th>
                        <th class="p-2 border">Invoice Number</th>
                        <th class="p-2 border">Date</th>
                        <th class="p-2 border">Total Amount</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">phone</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saleInvoices as $saleInvoice)
                        <tr class="hover:bg-gray-100">
                            <td class="p-2 border">{{ $saleInvoice->id }}</td>
                            <td class="p-2 border">{{ $saleInvoice->customer->name ?? 'N/A' }}</td>
                            <td class="p-2 border">{{ $saleInvoice->invoice_number }}</td>
                            <td class="p-2 border">{{ $saleInvoice->date }}</td>
                            <td class="p-2 border">{{ $saleInvoice->total_amount }}</td>
                            <td class="p-2 border">{{ $saleInvoice->status }}</td>
                            <td class="p-2 border">{{ $saleInvoice->phone }}</td>
                            <td class="p-2 border">
                                <a href="{{ route('sales.show', $saleInvoice->id) }}" class="text-blue-500">View</a>
                                <a href="{{ route('sales.edit', $saleInvoice->id) }}" class="text-green-500">Edit</a>
                                <form action="{{ route('sales.destroy', $saleInvoice->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection