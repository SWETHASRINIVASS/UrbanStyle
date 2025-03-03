<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/suppliers/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Supplier Details</h1>
            <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
                <tbody>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID</th>
                        <td class="px-4 py-2">{{ $supplier->id }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Supplier Name</th>
                        <td class="px-4 py-2">{{ $supplier->name }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Phone</th>
                        <td class="px-4 py-2">{{ $supplier->phone }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Email</th>
                        <td class="px-4 py-2">{{ $supplier->email }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Address Line 1</th>
                        <td class="px-4 py-2">{{ $supplier->address_line_1 }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Address Line 2</th>
                        <td class="px-4 py-2">{{ $supplier->address_line_2 }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">City</th>
                        <td class="px-4 py-2">{{ $supplier->city }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">State</th>
                        <td class="px-4 py-2">{{ $supplier->state }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Country</th>
                        <td class="px-4 py-2">{{ $supplier->country }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Pin Code</th>
                        <td class="px-4 py-2">{{ $supplier->pin_code }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('suppliers.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>
</div>
@endsection