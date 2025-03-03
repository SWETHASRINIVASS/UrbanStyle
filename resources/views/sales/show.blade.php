<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/sales/show.blade.php -->
@extends('layouts.app')

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
                    <tr>
                        <th class="px-4 py-2 text-left">Customer</th>
                        <td class="px-4 py-2">{{ $saleInvoice->customer->name ?? 'N/A' }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Invoice Number</th>
                        <td class="px-4 py-2">{{ $saleInvoice->invoice_number }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Date</th>
                        <td class="px-4 py-2">{{ $saleInvoice->date }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Amount</th>
                        <td class="px-4 py-2">{{ $saleInvoice->amount }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Discount</th>
                        <td class="px-4 py-2">{{ $saleInvoice->discount }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Tax Price</th>
                        <td class="px-4 py-2">{{ $saleInvoice->tax_price }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Round Off</th>
                        <td class="px-4 py-2">{{ $saleInvoice->round_off }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Total Amount</th>
                        <td class="px-4 py-2">{{ $saleInvoice->total_amount }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Status</th>
                        <td class="px-4 py-2">{{ $saleInvoice->status }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Customer Phone</th>
                        <td class="px-4 py-2">{{ $saleInvoice->phone }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <a href="{{ route('sales.edit', $saleInvoice->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('sales.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>
</div>
@endsection