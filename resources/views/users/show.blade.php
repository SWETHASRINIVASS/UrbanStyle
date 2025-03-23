<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\users\show.blade.php -->
@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">User Details</h1>

    <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
        <tbody>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Name</th>
                <td class="px-4 py-2">{{ $user->name }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Email</th>
                <td class="px-4 py-2">{{ $user->email }}</td>
            </tr>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Role</th>
                <td class="px-4 py-2">{{ $user->role }}</td>
            </tr>
            <tr>
                <th class="px-4 py-2 text-left">Status</th>
                <td class="px-4 py-2">{{ $user->status ? 'Active' : 'Inactive' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('users.edit', $user->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
        <a href="{{ route('users.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection