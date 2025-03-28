@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 shadow rounded">
        
        <h3 class="text-lg font-bold">Total Sales</h3>
        <p class="text-2xl font-semibold text-green-500">₹{{ number_format($totalSales ?? 0, 2) }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        
        <h3 class="text-lg font-bold">Total Purchases</h3>
        <p class="text-2xl font-semibold text-red-500">₹{{ number_format($totalPurchases ?? 0, 2) }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h3 class="text-lg font-bold">Total Expenses</h3>
        <p class="text-2xl font-semibold text-yellow-500">₹{{ number_format($totalExpenses ?? 0, 2) }}</p>
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

<!-- Chart Section -->
<div class="bg-white p-4 shadow rounded">
    <h3 class="text-lg font-bold mb-4">Sales vs Purchases (Monthly)</h3>
    <canvas id="salesChart" class="h-64"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart');
        
        if (!ctx) {
            console.error("Canvas element with ID 'salesChart' not found!");
            return;
        }

        const salesData = @json($salesData);
        const purchaseData = @json($purchaseData);

        console.log("Sales Data:", salesData);
        console.log("Purchase Data:", purchaseData);

        if (!salesData || !purchaseData) {
            console.error("Chart data is missing!");
            return;
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Sales',
                        data: salesData,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Purchases',
                        data: purchaseData,
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
    });
</script>
@endsection


