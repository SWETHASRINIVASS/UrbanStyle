<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/taxes/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create Tax')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Create New Tax</h1>

    

    <form action="{{ route('taxes.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group mb-4">
                <label for="tax_name" class="block text-gray-700">Tax Name</label>
                <input type="text" name="tax_name" id="tax_name" class="form-control mt-1 block w-full" value="{{ old('tax_name') }}" required>
            </div>
            <div class="form-group mb-4">
                <label for="tax_rate" class="block text-gray-700">Tax Rate (%)</label>
                <input type="number" name="tax_rate" id="tax_rate" class="form-control mt-1 block w-full" value="{{ old('tax_rate') }}" step="0.01" required>
            </div>
        </div>

        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('taxes.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
    </form>
</div>
@endsection