<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\purchase_returns\edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Purchase Return')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Purchase Return</h1>

    <form action="{{ route('purchase_returns.update', $purchaseReturn->id) }}" method="POST" 
        x-data="{
            items: {{ json_encode($purchaseReturn->purchaseReturnitems->map(function($item) {
                return [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    
                ];
            })) }},
            calculateTotalAmount(item) {
            const price = parseFloat(item.price || 0);
            const quantity = parseFloat(item.quantity || 0);
            return (price * quantity).toFixed(2);            },
            get totalAmount() {
                return this.items.reduce((sum, item) => sum + parseFloat(this.calculateTotalAmount(item) || 0), 0).toFixed(2);
            }
        }"
    >
        @csrf
        @method('PUT')

        <!-- Supplier and Invoice Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group mb-4">
                <label for="purchase_invoice_id" class="block text-gray-700">Purchase Invoice</label>
                <select name="purchase_invoice_id" id="purchase_invoice_id" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Invoice</option>
                    @foreach($purchaseInvoices as $invoice)
                        <option value="{{ $invoice->id }}" {{ $purchaseReturn->purchase_invoice_id == $invoice->id ? 'selected' : '' }}>
                            {{ $invoice->invoice_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="supplier_id" class="block text-gray-700">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $purchaseReturn->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Return Reason -->
        <div class="form-group mb-4">
            <label for="return_reason" class="block text-gray-700">Return Reason</label>
            <textarea name="return_reason" id="return_reason" class="form-control mt-1 block w-full" rows="3" required>{{ $purchaseReturn->return_reason }}</textarea>
        </div>

        <!-- Return Date -->
        <div class="form-group mb-4">
            <label for="return_date" class="block text-gray-700">Return Date</label>
            <input type="date" name="return_date" id="return_date" class="form-control mt-1 block w-full" value="{{ $purchaseReturn->return_date }}" required>
        </div>

        <!-- Return Items -->
        <h2 class="text-xl font-bold mt-6">Return Items</h2>
        <table class="w-full border-collapse shadow-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Product</th>
                    <th class="p-2 border">Quantity</th>
                    <th class="p-2 border">Price</th>
                    <th class="p-2 border">Total Amount</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, index) in items" :key="index">
                    <tr>
                        <td class="p-2 border">
                            <select x-model="item.product_id" :name="`items[${index}][product_id]`" class="form-control w-full" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" x-bind:selected="item.product_id == {{ $product->id }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="p-2 border">
                            <input type="number" x-model="item.quantity" :name="`items[${index}][quantity]`" class="form-control w-full" min="1" required>
                        </td>
                        <td class="p-2 border">
                            <input type="number" x-model="item.price" :name="`items[${index}][price]`" class="form-control w-full" step="0.01" required>
                        </td>
                        
                        <td class="p-2 border">
                            <input type="number" x-bind:value="calculateTotalAmount(item)" class="form-control w-full" readonly>
                        </td>
                        <td class="p-2 border">
                            <button type="button" @click="items.splice(index, 1)" class="text-red-500">Remove</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- Add Item Button -->
        <button type="button" @click="items.push({ product_id: '', quantity: 1, price: 0,total_amount: 0 })"
            class="bg-gray-800 text-white px-4 py-2 rounded mt-4">Add Item</button>

        <!-- Total Amount -->
        <div class="mt-6">
            <label for="total_amount" class="block text-gray-700">Total Amount</label>
            <input type="number" id="total_amount" x-model="totalAmount" class="form-control mt-1 block w-full" readonly>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Update Purchase Return</button>
            <a href="{{ route('purchase_returns.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection