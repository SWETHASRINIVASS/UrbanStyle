<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/customers/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Customer</h1>
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Customer Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $customer->phone }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}">
                </div>
                <div class="form-group">
                    <label for="address_line_1">Address Line 1</label>
                    <input type="text" name="address_line_1" id="address_line_1" class="form-control" value="{{ $customer->address_line_1 }}">
                </div>
                <div class="form-group">
                    <label for="address_line_2">Address Line 2</label>
                    <input type="text" name="address_line_2" id="address_line_2" class="form-control" value="{{ $customer->address_line_2 }}">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ $customer->city }}">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ $customer->state }}">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" class="form-control" value="{{ $customer->country }}">
                </div>
                <div class="form-group">
                    <label for="pin_code">Pin Code</label>
                    <input type="text" name="pin_code" id="pin_code" class="form-control" value="{{ $customer->pin_code }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection