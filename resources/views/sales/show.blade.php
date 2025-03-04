<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/sales/show.blade.php -->
@extends('layouts.app')

@section('title', 'Sale Invoice Details')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Sale Invoice Details</h1>
            <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
                <tbody>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID</th>
                        <td class="px-4 py-2">{{ $saleInvoice->id }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Invoice Number</th>
                        <td class="px-4 py-2">{{ $saleInvoice->invoice_number }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Customer</th>
                        <td class="px-4 py-2">{{ $saleInvoice->customer->name ?? 'N/A' }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Invoice Date</th>
                        <td class="px-4 py-2">{{ $saleInvoice->invoice_date }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Total Amount</th>
                        <td class="px-4 py-2">{{ $saleInvoice->total_amount }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Status</th>
                        <td class="px-4 py-2">{{ $saleInvoice->status }}</td>
                    </tr>
                </tbody>
            </table>

            <h2 class="text-xl font-bold mt-6">Invoice Items</h2>
            <table class="w-full border-collapse shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">Product</th>
                        <th class="p-2 border">Quantity</th>
                        <th class="p-2 border">Price</th>
                        <th class="p-2 border">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saleInvoice->saleInvoiceItems as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="p-2 border">{{ $item->product->name }}</td>
                            <td class="p-2 border">{{ $item->quantity }}</td>
                            <td class="p-2 border">{{ $item->price }}</td>
                            <td class="p-2 border">{{ $item->quantity * $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <a href="{{ route('sales.edit', $saleInvoice->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('sales.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>
</div>
@endsection