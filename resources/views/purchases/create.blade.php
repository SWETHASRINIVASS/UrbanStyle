@extends('layouts.app')

@section('title', 'Create Purchase Invoice')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">New Purchase Invoice</h1>

    <form action="{{ route('purchases.store') }}" method="POST" x-data="{
            items: [],
    globalDiscount: 0,
    get total() {
        return this.items.reduce((sum, item) => sum + (item.quantity * item.price), 0).toFixed(2);
    },
    get totalTax() {
        return this.items.reduce((sum, item) => sum + ((item.quantity * item.price - (item.quantity * item.price * (item.discount / 100))) * (item.tax_rate / 100)), 0).toFixed(2);
    },
    get totalDiscount() {
        return this.items.reduce((sum, item) => sum + (item.quantity * item.price * (item.discount / 100)), 0).toFixed(2);
    },
    get unroundedTotal() {
        return (parseFloat(this.total) - parseFloat(this.totalDiscount) + parseFloat(this.totalTax) - parseFloat(this.globalDiscount));
    },
    get roundOff() {
        return (Math.round(this.unroundedTotal) - this.unroundedTotal).toFixed(2);
    },
    get totalAmount() {
        return (Math.round(this.unroundedTotal)).toFixed(2);
    }
}">
        @csrf

        <!-- Supplier and Invoice Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group mb-4">
                <label for="supplier_id" class="block text-gray-700">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-control mt-1 block w-full" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="invoice_date" class="block text-gray-700">Invoice Date</label>
                <input type="date" name="invoice_date" id="invoice_date" class="form-control mt-1 block w-full" required>
            </div>
        </div>

        <!-- Invoice Items -->
        <h2 class="text-xl font-bold mt-6">Invoice Items</h2>
        <table class="w-full border-collapse shadow-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Product</th>
                    <th class="p-2 border">Quantity</th>
                    <th class="p-2 border">Price</th>
                    <th class="p-2 border">Discount (%)</th>
                    <th class="p-2 border">Tax Rate (%)</th>
                    <th class="p-2 border">Tax Amount</th>
                    <th class="p-2 border">Total</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, index) in items" :key="index">
                    <tr>
                        <td class="p-2 border">
                            <select x-model="item.product_id" :name="`items[${index}][product_id]`" class="w-full border p-2 rounded" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="p-2 border">
                            <input type="number" x-model="item.quantity" :name="`items[${index}][quantity]`" class="w-full border p-2 rounded" min="1" required>
                        </td>
                        <td class="p-2 border">
                            <input type="number" x-model="item.price" :name="`items[${index}][price]`" class="w-full border p-2 rounded" step="0.01" required>
                        </td>
                        <td class="p-2 border">
                            <input type="number" x-model="item.discount" :name="`items[${index}][discount]`" class="w-full border p-2 rounded" step="0.01">
                        </td>
                        <td class="p-2 border">
                            <select x-model="item.tax_rate" :name="`items[${index}][tax_rate]`" class="w-full border p-2 rounded">
                                <option value="">Select Tax Rate</option>
                                @foreach($taxes as $tax)
                                    <option value="{{ $tax->tax_rate }}">{{ $tax->tax_name }} ({{ $tax->tax_rate }}%)</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="p-2 border" x-text="((item.quantity * item.price - (item.quantity * item.price * (item.discount / 100))) * (item.tax_rate / 100)).toFixed(2)">
                            <!-- Tax Amount -->
                        </td>
                        <td class="p-2 border" x-text="((item.quantity * item.price - (item.quantity * item.price * (item.discount / 100))) + ((item.quantity * item.price - (item.quantity * item.price * (item.discount / 100))) * (item.tax_rate / 100))).toFixed(2)">
                            <!-- Total -->
                        </td>
                        <td class="p-2 border">
                            <button type="button" @click="items.splice(index, 1)" class="text-red-500">Remove</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- Add Product Button -->
        <button type="button" @click="items.push({ product_id: '', quantity: 1, price: 0, discount: 0, tax_rate: 0 })"
            class="bg-gray-800 text-white px-4 py-2 rounded mt-4">Add Product</button>

        <!-- Summary Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="form-group mb-4">
                <label for="global_discount" class="block text-gray-700">Global Discount</label>
                <input type="number" x-model="globalDiscount" name="global_discount" id="global_discount" class="form-control mt-1 block w-full" step="0.01">
            </div>
            <div class="form-group mb-4">
                <label for="round_off" class="block text-gray-700">Round Off</label>
                <input type="number" name="round_off" id="round_off" class="form-control mt-1 block w-full" x-model="roundOff" step="0.01" readonly>
            </div>
            <div class="form-group mb-4">
                <label for="total_amount" class="block text-gray-700">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control mt-1 block w-full" x-model="totalAmount" readonly>
            </div>
        </div>

        <!-- Submit and Cancel Buttons -->
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Save Invoice</button>
        <a href="{{ route('purchases.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
    </form>
</div>
@endsection