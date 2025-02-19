@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add New Customer</h1>
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Customer Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address_line_1">Address Line 1</label>
                    <input type="text" name="address_line_1" id="address_line_1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address_line_2">Address Line 2</label>
                    <input type="text" name="address_line_2" id="address_line_2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" class="form-control">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pin_code">Pin Code</label>
                    <input type="text" name="pin_code" id="pin_code" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

