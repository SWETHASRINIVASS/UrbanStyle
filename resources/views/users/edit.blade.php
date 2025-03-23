<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\users\edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Name -->
            <div class="form-group mb-4">
                <label for="name" class="block text-gray-700 font-medium">Name</label>
                <input type="text" name="name" id="name" class="form-control mt-1 block w-full" value="{{ $user->name }}" required>
            </div>

            <!-- Email -->
            <div class="form-group mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" class="form-control mt-1 block w-full" value="{{ $user->email }}" required>
            </div>

            <!-- Role -->
            <div class="form-group mb-4">
                <label for="role" class="block text-gray-700 font-medium">Role</label>
                <select name="role" id="role" class="form-control mt-1 block w-full" required>
                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Manager" {{ $user->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Accountant" {{ $user->role == 'Accountant' ? 'selected' : '' }}>Accountant</option>
                    <option value="Sales" {{ $user->role == 'Sales' ? 'selected' : '' }}>Sales</option>
                </select>
            </div>

            <!-- Status -->
            <div class="form-group mb-4">
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <select name="status" id="status" class="form-control mt-1 block w-full" required>
                    <option value="1" {{ $user->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$user->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-start mt-6">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded mr-2">Update User</button>
            <a href="{{ route('users.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection