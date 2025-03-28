@extends('layouts.app')

@section('content')
<div class="bg-white p-6 shadow-md rounded-md">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Customers</h1>
        <a href="{{ route('customers.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New Customer</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('customers.index') }}" class="mb-4">
        <div class="flex items-center">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search by Name" 
                class="form-control border p-2 rounded w-1/3"
            >
        
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded ml-2">Search</button>
        </div>
    </form>
    <table class="w-full border-collapse border border-gray-400">
            
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Phone</th>
                        <th class="p-2 border">Address</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr class="hover:bg-gray-100">
                            <td class="p-2 border">{{ $customer->id }}</td>
                            <td class="p-2 border">{{ $customer->name }}</td>
                            <td class="p-2 border">{{ $customer->phone }}</td>
                            <td class="p-2 border">{{ $customer->address_line_1}}</td>
                            <td class="p-2 border">{{ $customer->email }}</td>
                            <td class="p-2 border">
                                <a href="{{ route('customers.show', $customer->id) }}" class="text-blue-500">👁️</a>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="text-green-500">📝</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure you want to delete this customer?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    </div>
    
</div>
@endsection