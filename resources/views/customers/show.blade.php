<!-- filepath: /c:/xampp/htdocs/UrbanStyle/resources/views/customers/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-2xl font-bold mb-4">Customer Details</h1>
            <table class="table-auto w-full bg-gray-100 shadow-md rounded-lg">
                <tbody>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">ID</th>
                        <td class="px-4 py-2">{{ $customer->id }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <td class="px-4 py-2">{{ $customer->name }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Phone</th>
                        <td class="px-4 py-2">{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Email</th>
                        <td class="px-4 py-2">{{ $customer->email }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Address Line 1</th>
                        <td class="px-4 py-2">{{ $customer->address_line_1 }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Address Line 2</th>
                        <td class="px-4 py-2">{{ $customer->address_line_2 }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">City</th>
                        <td class="px-4 py-2">{{ $customer->city }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">State</th>
                        <td class="px-4 py-2">{{ $customer->state }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left">Country</th>
                        <td class="px-4 py-2">{{ $customer->country }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left">Pin Code</th>
                        <td class="px-4 py-2">{{ $customer->pin_code }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <a href="{{ route('customers.edit', $customer->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('customers.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>
</div>
@endsection