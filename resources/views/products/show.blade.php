<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Product Details</h1>
            <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
                <tbody>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID</th>
                        <td class="px-4 py-2">{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Category</th>
                        <td class="px-4 py-2">{{ $product->category->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Supplier</th>
                        <td class="px-4 py-2">{{ $product->supplier->name ?? 'N/A' }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Purchase Price</th>
                        <td class="px-4 py-2">{{ $product->purchase_price }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Sale Price</th>
                        <td class="px-4 py-2">{{ $product->sale_price }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Current Stock</th>
                        <td class="px-4 py-2">{{ $product->current_stock }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">HSN Code</th>
                        <td class="px-4 py-2">{{ $product->hsn_code }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <a href="{{ route('products.edit', $product->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('products.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>
</div>
@endsection