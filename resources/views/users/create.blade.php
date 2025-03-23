<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\users\create.blade.php -->
@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Create New User</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Name -->
            <div class="form-group mb-4">
                <label for="name" class="block text-gray-700 font-medium">Name</label>
                <input type="text" name="name" id="name" class="form-control mt-1 block w-full" value="{{ old('name') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" class="form-control mt-1 block w-full" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div class="form-group mb-4">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password" class="form-control mt-1 block w-full" required>
            </div>

            <!-- Confirm Password -->
            <div class="form-group mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mt-1 block w-full" required>
            </div>

            <!-- Role -->
            <div class="form-group mb-4">
                <label for="role" class="block text-gray-700 font-medium">Role</label>
                <select name="role" id="role" class="form-control mt-1 block w-full" required>
                    <option value="">Select Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Manager">Manager</option>
                    <option value="Accountant">Accountant</option>
                    <option value="Sales">Sales</option>
                </select>
            </div>

            <!-- Status -->
            <div class="form-group mb-4">
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <select name="status" id="status" class="form-control mt-1 block w-full" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-start mt-6">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded mr-2">Create User</button>
            <a href="{{ route('users.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection