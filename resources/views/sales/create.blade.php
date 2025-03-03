@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Add New Sale Invoice</h1>
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group mb-4">
                        <label for="customer_id" class="block text-gray-700">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control mt-1 block w-full">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-4">
                        <label for="invoice_number" class="block text-gray-700">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number" class="form-control mt-1 block w-full" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="date" class="block text-gray-700">Date</label>
                        <input type="date" name="date" id="date" class="form-control mt-1 block w-full" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="amount" class="block text-gray-700">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control mt-1 block w-full" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="discount" class="block text-gray-700">Discount</label>
                        <input type="number" name="discount" id="discount" class="form-control mt-1 block w-full">
                    </div>
                    <div class="form-group mb-4">
                        <label for="tax_price" class="block text-gray-700">Tax Price</label>
                        <input type="number" name="tax_price" id="tax_price" class="form-control mt-1 block w-full">
                    </div>
                    <div class="form-group mb-4">
                        <label for="round_off" class="block text-gray-700">Round Off</label>
                        <input type="number" name="round_off" id="round_off" class="form-control mt-1 block w-full">
                    </div>
                    <div class="form-group mb-4">
                        <label for="total_amount" class="block text-gray-700">Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount" class="form-control mt-1 block w-full" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="status" class="block text-gray-700">Status</label>
                        <input type="text" name="status" id="status" class="form-control mt-1 block w-full" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="customer_phone" class="block text-gray-700">Customer Phone</label>
                        <input type="text" name="phone" id="customer_phone" class="form-control mt-1 block w-full">
                    </div>
                </div>
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Save</button>
                <a href="{{ route('sales.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection