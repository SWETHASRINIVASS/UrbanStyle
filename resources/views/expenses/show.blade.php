<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/expenses/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Expense Details</h1>
            <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
                <tbody>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID</th>
                        <td class="px-4 py-2">{{ $expense->id }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <td class="px-4 py-2">{{ $expense->name }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Amount</th>
                        <td class="px-4 py-2">{{ $expense->amount }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Date</th>
                        <td class="px-4 py-2">{{ $expense->date }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Description</th>
                        <td class="px-4 py-2">{{ $expense->description }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <a href="{{ route('expenses.edit', $expense->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('expenses.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>
</div>
@endsection