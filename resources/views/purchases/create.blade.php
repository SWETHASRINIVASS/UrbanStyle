@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add New Purchase Invoice</h1>
            <form action="{{ route('purchases.store') }}" method="POST">
                
                @csrf
                <div class="form-group">
                    <label for="supplier_id">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" name="invoice_number" id="invoice_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="invoice_date">Invoice Date</label>
                    <input type="date" name="invoice_date" id="invoice_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="total_amount">Total Amount</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="paid_amount">Paid Amount</label>
                    <input type="number" name="paid_amount" id="paid_amount" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="due_amount">Due Amount</label>
                    <input type="number" name="due_amount" id="due_amount" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('purchases.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection