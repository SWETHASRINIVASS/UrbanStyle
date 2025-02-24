<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/sales/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add New Sale Invoice</h1>
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="customer_id">Customer</label>
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" name="invoice_number" id="invoice_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" name="discount" id="discount" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tax_price">Tax Price</label>
                    <input type="number" name="tax_price" id="tax_price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="round_off">Round Off</label>
                    <input type="number" name="round_off" id="round_off" class="form-control">
                </div>
                <div class="form-group">
                    <label for="total_amount">Total Amount</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customer_phone">Customer Phone</label>
                    <input type="text" name="phone" id="customer_phone" class="form-control">
                </div>

                
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection