<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Retail Billing System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-gray-800 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('sales.index') }}" class="text-lg font-bold">Urban Style</a>
            <ul class="flex gap-4">
                <li><a href="{{ route('customers.index') }}" class="hover:underline">Customer</a></li>
                <li><a href="{{ route('suppliers.index') }}" class="hover:underline">Supplier</a></li>
                <li><a href="{{ route('categories.index') }}" class="hover:underline">Category</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:underline">Product</a></li>
                <li><a href="{{ route('sales.index') }}" class="hover:underline">Sale</a></li>
                <li><a href="{{ route('purchases.index') }}" class="hover:underline">Purchase</a></li>
                <li><a href="{{ route('expenses.index') }}" class="hover:underline">Expenses</a></li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        @yield('content')
    </div>

</body>
</html>