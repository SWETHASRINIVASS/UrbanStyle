<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/purchases/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Edit Purchase Invoice</h1>
            <form action="{{ route('purchases.update', $purchaseInvoice->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group mb-4">
                        <label for="supplier_id" class="block text-gray-700">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control mt-1 block w-full">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $supplier->id == $purchaseInvoice->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="invoice_number" class="block text-gray-700">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control mt-1 block w-full" value="{{ $purchaseInvoice->invoice_number }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="invoice_date" class="block text-gray-700">Invoice Date</label>
                        <input type="date" name="invoice_date" id="invoice_date" class="form-control mt-1 block w-full" value="{{ $purchaseInvoice->invoice_date }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="total_amount" class="block text-gray-700">Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount" class="form-control mt-1 block w-full" value="{{ $purchaseInvoice->total_amount }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="paid_amount" class="block text-gray-700">Paid Amount</label>
                        <input type="number" name="paid_amount" id="paid_amount" class="form-control mt-1 block w-full" value="{{ $purchaseInvoice->paid_amount }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="due_amount" class="block text-gray-700">Due Amount</label>
                        <input type="number" name="due_amount" id="due_amount" class="form-control mt-1 block w-full" value="{{ $purchaseInvoice->due_amount }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="status" class="block text-gray-700">Status</label>
                        <input type="text" name="status" id="status" class="form-control mt-1 block w-full" value="{{ $purchaseInvoice->status }}" required>
                    </div>
                </div>
                
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Save</button>
                    <a href="{{ route('purchases.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
                
            </form>
        </div>
    </div>
</div>
@endsection