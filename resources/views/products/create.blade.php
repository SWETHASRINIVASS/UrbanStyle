@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add New Product</h1>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="supplier_id">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="purchase_price">Purchase Price</label>
                    <input type="number" name="purchase_price" id="purchase_price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="sale_price">Sale Price</label>
                    <input type="number" name="sale_price" id="sale_price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="current_stock">Current Stock</label>
                    <input type="number" name="current_stock" id="current_stock" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="hsn_code">HSN Code</label>
                    <input type="text" name="hsn_code" id="hsn_code" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection