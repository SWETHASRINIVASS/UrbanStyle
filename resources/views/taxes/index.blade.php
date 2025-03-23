<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/taxes/index.blade.php -->
@extends('layouts.app')

@section('title', 'Taxes')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Taxes</h1>
        <a href="{{ route('taxes.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Create New Tax</a>
    </div>

    {{-- @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif --}}

    <table class="w-full border-collapse shadow-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Tax Name</th>
                <th class="p-2 border">Tax Rate(%)</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($taxes as $tax)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $tax->id }}</td>
                    <td class="p-2 border">{{ $tax->tax_name }}</td>
                    <td class="p-2 border">{{ $tax->tax_rate }}%</td>
                    <td class="p-2 border">
                        <a href="{{ route('taxes.show', $tax->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('taxes.edit', $tax->id) }}" class="text-green-500">Edit</a>
                        <form action="{{ route('taxes.destroy', $tax->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection