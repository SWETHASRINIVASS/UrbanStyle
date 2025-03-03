<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/expenses/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Edit Expense</h1>
            <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="form-control mt-1 block w-full" value="{{ $expense->name }}" required>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="amount" class="block text-gray-700">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control mt-1 block w-full" value="{{ $expense->amount }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="date" class="block text-gray-700">Date</label>
                        <input type="date" name="date" id="date" class="form-control mt-1 block w-full" value="{{ $expense->date }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="description" class="block text-gray-700">Description</label>
                        <input type="text" name="description" id="description" class="form-control mt-1 block w-full" value="{{ $expense->description }}" required>
                    </div>
                    
                </div>
                <div class="flex justify-start space-x-4 mt-4">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Save</button>
                    <a href="{{ route('expenses.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection