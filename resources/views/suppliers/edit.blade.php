<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/suppliers/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Edit Supplier</h1>
            
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group mb-4">
                        <label for="name" class="block text-gray-700">Supplier Name</label>
                        <input type="text" name="name" id="name" class="form-control mt-1 block w-full" value="{{ $supplier->name }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="phone" class="block text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control mt-1 block w-full" value="{{ $supplier->phone }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="form-control mt-1 block w-full" value="{{ $supplier->email }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="address_line_1" class="block text-gray-700">Address Line 1</label>
                        <input type="text" name="address_line_1" id="address_line_1" class="form-control mt-1 block w-full" value="{{ $supplier->address_line_1 }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="address_line_2" class="block text-gray-700">Address Line 2</label>
                        <input type="text" name="address_line_2" id="address_line_2" class="form-control mt-1 block w-full" value="{{ $supplier->address_line_2 }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="city" class="block text-gray-700">City</label>
                        <input type="text" name="city" id="city" class="form-control mt-1 block w-full" value="{{ $supplier->city }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="state" class="block text-gray-700">State</label>
                        <input type="text" name="state" id="state" class="form-control mt-1 block w-full" value="{{ $supplier->state }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="country" class="block text-gray-700">Country</label>
                        <input type="text" name="country" id="country" class="form-control mt-1 block w-full" value="{{ $supplier->country }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="pin_code" class="block text-gray-700">Pin Code</label>
                        <input type="text" name="pin_code" id="pin_code" class="form-control mt-1 block w-full" value="{{ $supplier->pin_code }}">
                    </div>
                </div>
                <div class="flex justify-start space-x-4 mt-4">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Save</button>
                    <a href="{{ route('suppliers.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection