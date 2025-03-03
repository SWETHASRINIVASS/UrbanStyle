@extends('layouts.app')

@section('content')
<div class="bg-white p-6 shadow-md rounded-md">
    <div class="flex justify-between items-center mb-4">
        
            <h1 class="text-2xl font-bold">Products</h1>
            <a href="{{ route('products.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New Product</a>
    </div>
            <table class="w-full border-collapse border border-gray-400">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Category</th>
                        <th class="p-2 border">Supplier</th>
                        <th class="p-2 border">Purchase Price</th>
                        <th class="p-2 border">Sale Price</th>
                        <th class="p-2 border">Current Stock</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-100">
                            <td class="p-2 border">{{ $product->id }}</td>
                            <td class="p-2 border">{{ $product->name }}</td>
                            <td class="p-2 border">{{ $product->category->name }}</td>
                            <td class="p-2 border">{{ $product->supplier->name }}</td>
                            <td class="p-2 border">{{ $product->purchase_price }}</td>
                            <td class="p-2 border">{{ $product->sale_price }}</td>
                            <td class="p-2 border">{{ $product->current_stock }}</td>
                            <td class="p-2 border">
                                <a href="{{ route('products.show', $product->id) }}" class="text-blue-500">View</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="text-green-500">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
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