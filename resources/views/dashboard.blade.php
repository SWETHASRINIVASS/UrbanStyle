@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Total Sales</h3>
        <p class="text-2xl font-semibold text-green-500">$100,000</p>
    </div>
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Total Purchases</h3>
        <p class="text-2xl font-semibold text-red-500">$50,000</p>
    </div>
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Total Expenses</h3>
        <p class="text-2xl font-semibold text-yellow-500">$20,000</p>
    </div>
</div>
@endsection
