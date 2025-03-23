<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/taxes/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Tax')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Tax</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('taxes.update', $tax->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group mb-4">
                <label for="tax_name" class="block text-gray-700">Tax Name</label>
                <input type="text" name="tax_name" id="tax_name" class="form-control mt-1 block w-full" value="{{ old('tax_name', $tax->tax_name) }}" required>
            </div>
            <div class="form-group mb-4">
                <label for="tax_rate" class="block text-gray-700">Tax Rate (%)</label>
                <input type="number" name="tax_rate" id="tax_rate" class="form-control mt-1 block w-full" value="{{ old('tax_rate', $tax->tax_rate) }}" step="0.01" required>
            </div>
        </div>

        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('taxes.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
    </form>
</div>
@endsection