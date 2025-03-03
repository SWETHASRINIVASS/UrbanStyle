<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/suppliers/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white p-6 shadow-md rounded-md">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Suppliers</h1>
                <a href="{{ route('suppliers.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New Supplier</a>
            </div>

            <table class="w-full border-collapse shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Phone</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                        <tr class="hover:bg-gray-100">
                            <td class="p-2 border">{{ $supplier->id }}</td>
                            <td class="p-2 border">{{ $supplier->name }}</td>
                            <td class="p-2 border">{{ $supplier->phone }}</td>
                            <td class="p-2 border">{{ $supplier->email }}</td>
                            <td class="p-2 border">
                                <a href="{{ route('suppliers.show', $supplier->id) }}" class="text-blue-500">View</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="text-green-500">Edit</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection