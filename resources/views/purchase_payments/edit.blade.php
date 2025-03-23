<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\purchase_payments\edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Purchase Payment')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Purchase Payment</h1>

    <form action="{{ route('purchase_payments.update', $purchasePayment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Purchase Invoice Selection -->
        <div class="form-group mb-4">
            <label for="purchase_invoice_id" class="block text-gray-700 font-medium">Purchase Invoice</label>
            <select name="purchase_invoice_id" id="purchase_invoice_id" class="form-control mt-1 block w-full" required>
                <option value="">Select Invoice</option>
                @foreach($purchaseInvoices as $invoice)
                    <option value="{{ $invoice->id }}">
                        {{ $invoice->invoice_number }} - {{ $invoice->supplier->name ?? 'N/A'}} - {{ $invoice->total_amount }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-4">
            <label for="supplier_id" class="block text-gray-700 font-medium">Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control mt-1 block w-full" required>
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Payment Amount -->
        <div class="form-group mb-4">
            <label for="amount" class="block text-gray-700">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control mt-1 block w-full" step="0.01" min="0" value="{{ $purchasePayment->amount }}" required>
        </div>

        <!-- Round Off -->
        <div class="form-group mb-4">
            <label for="round_off" class="block text-gray-700">Round Off</label>
            <input type="number" name="round_off" id="round_off" class="form-control mt-1 block w-full" step="0.01" value="{{ $purchasePayment->round_off }}">
        </div>

        <!-- Total Amount -->
        <div class="form-group mb-4">
            <label for="total_amount" class="block text-gray-700">Total Amount</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control mt-1 block w-full" step="0.01" min="0" value="{{ $purchasePayment->total_amount }}" required>
        </div>

        <!-- Payment Date -->
        <div class="form-group mb-4">
            <label for="date" class="block text-gray-700">Payment Date</label>
            <input type="date" name="date" id="date" class="form-control mt-1 block w-full" value="{{ $purchasePayment->date }}" required>
        </div>

        <!-- Payment Method -->
        <div class="form-group mb-4">
            <label for="payment_method" class="block text-gray-700">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-control mt-1 block w-full" required>
                <option value="">Select Payment Method</option>
                <option value="Cash" {{ $purchasePayment->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Card" {{ $purchasePayment->payment_method == 'Card' ? 'selected' : '' }}>Card</option>
                <option value="Bank Transfer" {{ $purchasePayment->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                <option value="Cheque" {{ $purchasePayment->payment_method == 'Cheque' ? 'selected' : '' }}>Cheque</option>
            </select>
        </div>

        <!-- Balance Due -->
        <div class="form-group mb-4">
            <label for="balance_due" class="block text-gray-700">Balance Due</label>
            <input type="number" name="balance_due" id="balance_due" class="form-control mt-1 block w-full" step="0.01" min="0" value="{{ $purchasePayment->balance_due }}">
        </div>

        <!-- Payment Status -->
        <div class="form-group mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <select name="status" id="status" class="form-control mt-1 block w-full" required>
                <option value="">Select Status</option>
                <option value="Pending" {{ $purchasePayment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ $purchasePayment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
    </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Update Payment</button>
        <a href="{{ route('purchase_payments.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
    </form>
</div>
@endsection