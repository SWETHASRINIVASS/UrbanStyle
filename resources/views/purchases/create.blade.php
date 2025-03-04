<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/purchases/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Purchase Invoice')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Add New Purchase Invoice</h1>
            <form action="{{ route('purchases.store') }}" method="POST" x-data="{ items: [], taxRate: 0, get subtotal() { return this.items.reduce((sum, item) => sum + (item.quantity * item.price), 0).toFixed(2); }, get taxAmount() { return (this.subtotal * (this.taxRate / 100)).toFixed(2); }, get totalAmount() { return (parseFloat(this.subtotal) + parseFloat(this.taxAmount)).toFixed(2); } }">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group mb-4">
                        <label for="supplier_id" class="block text-gray-700">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control mt-1 block w-full">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="invoice_number" class="block text-gray-700">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control mt-1 block w-full" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="invoice_date" class="block text-gray-700">Invoice Date</label>
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control mt-1 block w-full" required>
                    </div>
                </div>

                <h2 class="text-xl font-bold mt-6">Invoice Items</h2>
                <table class="w-full border-collapse shadow-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Product</th>
                            <th class="p-2 border">Quantity</th>
                            <th class="p-2 border">Price</th>
                            <th class="p-2 border">Subtotal</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, index) in items" :key="index">
                            <tr>
                                <td class="p-2 border">
                                    <select x-model="item.product_id" :name="'items[' + index + '][product_id]'" class="w-full border p-2 rounded">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-2 border">
                                    <input type="number" x-model="item.quantity" :name="'items[' + index + '][quantity]'" class="w-full border p-2 rounded" min="1">
                                </td>
                                <td class="p-2 border">
                                    <input type="number" x-model="item.price" :name="'items[' + index + '][price]'" class="w-full border p-2 rounded" step="0.01">
                                </td>
                                <td class="p-2 border" x-text="(item.quantity * item.price).toFixed(2)"></td>
                                <td class="p-2 border">
                                    <button type="button" @click="items.splice(index, 1)" class="text-red-500">Remove</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <!-- Styled "Add Product" Button -->
                <button type="button" @click="items.push({ product_id: '', quantity: 1, price: 0 })"
                    class="bg-gray-800 text-white px-4 py-2 rounded mt-4"> Add Product
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="form-group mb-4">
                        <label for="tax_rate" class="block text-gray-700">Tax Rate (%)</label>
                        <input type="number" x-model="taxRate" name="tax_rate" id="tax_rate" class="form-control mt-1 block w-full" step="0.01">
                    </div>
                    <div class="form-group mb-4">
                        <label for="subtotal" class="block text-gray-700">Subtotal</label>
                        <input type="number" name="subtotal" id="subtotal" class="form-control mt-1 block w-full" x-model="subtotal" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tax_amount" class="block text-gray-700">Tax Amount</label>
                        <input type="number" name="tax_amount" id="tax_amount" class="form-control mt-1 block w-full" x-model="taxAmount" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="total_amount" class="block text-gray-700">Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount" class="form-control mt-1 block w-full" x-model="totalAmount" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="status" class="block text-gray-700">Status</label>
                        <input type="text" name="status" id="status" class="form-control mt-1 block w-full" required>
                    </div>
                </div>

                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Save</button>
                <a href="{{ route('purchases.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection