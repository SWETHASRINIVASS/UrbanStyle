<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/products/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Product</h1>
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supplier_id">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == $product->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="purchase_price">Purchase Price</label>
                    <input type="number" name="purchase_price" id="purchase_price" class="form-control" value="{{ $product->purchase_price }}" required>
                </div>
                <div class="form-group">
                    <label for="sale_price">Sale Price</label>
                    <input type="number" name="sale_price" id="sale_price" class="form-control" value="{{ $product->sale_price }}" required>
                </div>
                <div class="form-group">
                    <label for="current_stock">Current Stock</label>
                    <input type="number" name="current_stock" id="current_stock" class="form-control" value="{{ $product->current_stock }}" required>
                </div>
                <div class="form-group">
                    <label for="hsn_code">HSN Code</label>
                    <input type="text" name="hsn_code" id="hsn_code" class="form-control" value="{{ $product->hsn_code }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection