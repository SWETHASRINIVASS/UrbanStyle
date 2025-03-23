<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\users\index.blade.php -->
@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Users</h1>
        <a href="{{ route('users.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New User</a>
    </div>

    <table class="w-full border-collapse border border-gray-400">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $user->id }}</td>
                    <td class="p-2 border">{{ $user->name }}</td>
                    <td class="p-2 border">{{ $user->email }}</td>
                    <td class="p-2 border">{{ $user->role }}</td>
                    <td class="p-2 border">{{ $user->status ? 'Active' : 'Inactive' }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('users.show', $user->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="text-green-500 ml-2">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-2 border text-center">No users found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection