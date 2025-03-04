<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/categories/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Edit Category</h1>
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-4">
                    <label for="name" class="block text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control mt-1 block w-full" value="{{ $category->name }}" required>
                </div>
                <div class="flex justify-start space-x-4 mt-4">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Save</button>
                    <a href="{{ route('categories.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection