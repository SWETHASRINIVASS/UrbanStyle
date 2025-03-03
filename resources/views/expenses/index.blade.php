<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/expenses/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Expenses</h1>
        <a href="{{ route('expenses.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded">New Expense</a>
    </div>
    <table class="w-full border-collapse border border-gray-400">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">name</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $expense->id }}</td>
                    <td class="p-2 boredr">{{ $expense->name }}</td>
                    <td class="p-2 border">{{ $expense->amount }}</td>
                    <td class="p-2 border">{{ $expense->date }}</td>
                    <td class="p-2 border">{{ $expense->description }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('expenses.show', $expense->id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('expenses.edit', $expense->id) }}" class="text-green-500">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline-block;">
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
@endsection