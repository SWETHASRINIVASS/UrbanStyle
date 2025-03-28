<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Retail Billing System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tom Select CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<!-- Tom Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#customer_id', {
                create: false,
                onItemAdd: function(value, item) {
                    console.log('Item added:', value);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#product_id', {
                create: false,
                sortField: { field: "text", direction: "asc" },
                placeholder: "Select a Product...",
                onItemAdd: function(value, item) {
                    console.log('Item added:', value);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#supplier_id', {
                create: false,
                onItemAdd: function(value, item) {
                    console.log('Item added:', value);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#category_id', {
                create: false,
                onItemAdd: function(value, item) {
                    console.log('Item added:', value);
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new TomSelect("#tax_rate", {
                create: false, 
                sortField: { field: "text", direction: "asc" },
                placeholder: "Select a Tax Rate...",
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new TomSelect("#sale_invoice_id", {
                create: false, 
                sortField: { field: "text", direction: "asc" },
                placeholder: "Select a Sale Invoice...",
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#purchase_invoice_id', {
                create: false,
                sortField: { field: "text", direction: "asc" },
                placeholder: "Select a Purchase Invoice...",
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#payment_method', {
                create: false,
                sortField: { field: "text", direction: "asc" },
                placeholder: "Select a Payment Method...",
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#status', {
                create: false,
                sortField: { field: "text", direction: "asc" },
                placeholder: "Select a Payment Type...",
            });
        });
    </script>
    
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-gray-800 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('sales.index') }}" class="text-lg font-bold">Urban Style</a>
            <ul class="flex gap-6">
                <li><a href="{{ route('customers.index') }}" class="hover:underline">Customer</a></li>
                <li><a href="{{ route('suppliers.index') }}" class="hover:underline">Supplier</a></li>
                <li><a href="{{ route('categories.index') }}" class="hover:underline">Category</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:underline">Products</a></li>

                <!-- Sales Dropdown -->
                <li class="relative" x-data="{ open: false }">
                    <button 
                        @click="open = !open" 
                        @click.away="open = false" 
                        class="hover:underline focus:outline-none flex items-center gap-1"
                        aria-haspopup="true" 
                        :aria-expanded="open"
                    >
                        Sales
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg> --}}
                    </button>
                    <ul 
                        x-show="open" 
                        x-transition:enter="transition ease-out duration-200" 
                        x-transition:enter-start="opacity-0 transform scale-95" 
                        x-transition:enter-end="opacity-100 transform scale-100" 
                        x-transition:leave="transition ease-in duration-150" 
                        x-transition:leave-start="opacity-100 transform scale-100" 
                        x-transition:leave-end="opacity-0 transform scale-95" 
                        class="absolute bg-white text-gray-900 w-48 mt-2 rounded shadow-lg z-10"
                    >
                        <li>
                            <a href="{{ route('sale_invoices.index') }}" class="block px-4 py-2 hover:bg-gray-600 rounded-t">
                                Sale Invoices
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sale_payments.index') }}" class="block px-4 py-2 hover:bg-gray-600 rounded-b">
                                Sale Payments
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sale_returns.index') }}" class="block px-4 py-2 hover:bg-gray-600 rounded-b">
                                Sale Returns
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Purchases Dropdown -->
                <li class="relative" x-data="{ open: false }">
                    <button 
                        @click="open = !open" 
                        @click.away="open = false" 
                        class="hover:underline focus:outline-none flex items-center gap-1"
                        aria-haspopup="true" 
                        :aria-expanded="open"
                    >
                        Purchases
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg> --}}
                    </button>
                    <ul 
                        x-show="open" 
                        x-transition:enter="transition ease-out duration-200" 
                        x-transition:enter-start="opacity-0 transform scale-95" 
                        x-transition:enter-end="opacity-100 transform scale-100" 
                        x-transition:leave="transition ease-in duration-150" 
                        x-transition:leave-start="opacity-100 transform scale-100" 
                        x-transition:leave-end="opacity-0 transform scale-95" 
                        class="absolute bg-white text-gray-900 w-48 mt-2 rounded shadow-lg z-10"
                    >
                        <li>
                            <a href="{{ route('purchase_invoices.index') }}" class="block px-4 py-2 hover:bg-gray-600 rounded-t">
                                Purchase Invoices
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('purchase_payments.index') }}" class="block px-4 py-2 hover:bg-gray-600 rounded-b">
                                Purchase Payments
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('purchase_returns.index') }}" class="block px-4 py-2 hover:bg-gray-600 rounded-b">
                                Purchase Returns
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li><a href="{{ route('reports.index') }}" class="hover:underline">Reports</a></li> --}}
                <li><a href="{{ route('users.index') }}" class="hover:underline">Users</a></li>
                <li><a href="{{ route('taxes.index') }}" class="hover:underline">Taxes</a></li>
                <li><a href="{{ route('expenses.index') }}" class="hover:underline">Expenses</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        @yield('content')
    </div>

</body>
</html>