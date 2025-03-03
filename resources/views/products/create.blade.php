@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">New Product</h1>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="form-group mb-4">
                    <label for="name" class="block text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control mt-1 block w-full" required>
                </div>

                <div class="form-group mb-4">
                    <label for="category_id" class="block text-gray-700">Category</label>
                    <select name="category_id" id="category_id" class="form-control mt-1 block w-full" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="supplier_id" class="block text-gray-700">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control mt-1 block w-full" required>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="purchase_price" class="block text-gray-700">Purchase Price</label>
                    <input type="number" name="purchase_price" id="purchase_price" class="form-control mt-1 block w-full" required>
                </div>

                <div class="form-group mb-4">
                    <label for="sale_price" class="block text-gray-700">Sale Price</label>
                    <input type="number" name="sale_price" id="sale_price"class="form-control mt-1 block w-full" required>
                </div>

                <div class="form-group mb-4">
                    <label for="current_stock" class="block text-gray-700">Current Stock</label>
                    <input type="number" name="current_stock" id="current_stock" class="form-control mt-1 block w-full" required>
                </div>

                <div class="form-group mb-4">
                    <label for="hsn_code" class="block text-gray-700">HSN Code</label>
                    <input type="text" name="hsn_code" id="hsn_code" class="form-control mt-1 block w-full">
                </div>
            </div>
                <button type="submit"class="bg-gray-800 text-white px-4 py-2 rounded">Save</button>
                <a href="{{ route('products.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
        </div>
            </form>
        </div>
    </div>
</div>
@endsection