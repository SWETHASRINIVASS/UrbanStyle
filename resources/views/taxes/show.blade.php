<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/taxes/show.blade.php -->
@extends('layouts.app')

@section('title', 'Tax Details')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Tax Details</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="form-group mb-4">
            <label for="tax_name" class="block text-gray-700">Tax Name</label>
            <input type="text" id="tax_name" class="form-control mt-1 block w-full" value="{{ $tax->tax_name }}" readonly>
        </div>
        <div class="form-group mb-4">
            <label for="tax_rate" class="block text-gray-700">Tax Rate (%)</label>
            <input type="number" id="tax_rate" class="form-control mt-1 block w-full" value="{{ $tax->tax_rate }}" readonly>
        </div>
    </div>

    <a href="{{ route('taxes.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back to List</a>
    <a href="{{ route('taxes.edit', $tax->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Edit</a>
    <form action="{{ route('taxes.destroy', $tax->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Delete</button>
    </form>
</div>
@endsection