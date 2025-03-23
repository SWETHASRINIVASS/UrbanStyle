<!-- filepath: c:\xampp\htdocs\UrbanStyle\resources\views\dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <!-- Total Sales -->
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Total Sales</h3>
        <p class="text-2xl font-semibold text-green-500">₹{{ number_format($totalSales, 2) }}</p>
    </div>

    <!-- Total Purchases -->
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Total Purchases</h3>
        <p class="text-2xl font-semibold text-red-500">₹{{ number_format($totalPurchases, 2) }}</p>
    </div>

    <!-- Total Expenses -->
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Total Expenses</h3>
        <p class="text-2xl font-semibold text-yellow-500">₹{{ number_format($totalExpenses, 2) }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Active Users</h3>
        <p class="text-2xl font-semibold text-blue-500">{{ $activeUsers }}</p>
    </div>
    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Inactive Users</h3>
        <p class="text-2xl font-semibold text-gray-500">{{ $inactiveUsers }}</p>
    </div>
</div>

<!-- Recent Activities -->
<div class="bg-white p-4 shadow rounded mb-6">
    <h3 class="text-lg font-bold mb-4">Recent Activities</h3>
    <ul class="divide-y divide-gray-200">
        <li class="py-2">
            <p class="text-sm text-gray-600">John Doe added a new sale invoice.</p>
            <span class="text-xs text-gray-400">2 hours ago</span>
        </li>
        <li class="py-2">
            <p class="text-sm text-gray-600">Jane Smith updated a purchase order.</p>
            <span class="text-xs text-gray-400">5 hours ago</span>
        </li>
        <li class="py-2">
            <p class="text-sm text-gray-600">Admin created a new user account.</p>
            <span class="text-xs text-gray-400">1 day ago</span>
        </li>
    </ul>
</div>

<!-- Chart Section -->
<div class="bg-white p-4 shadow rounded">
    <h3 class="text-lg font-bold mb-4">Sales vs Purchases (Monthly)</h3>
    <div id="chart" class="h-64">
        <canvas id="salesChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'], // Replace with dynamic labels if needed
            datasets: [
                {
                    label: 'Sales',
                    data: @json($salesData),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Purchases',
                    data: @json($purchaseData),
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>
@endsection