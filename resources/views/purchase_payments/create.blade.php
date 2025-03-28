
@extends('layouts.app')

@section('title', 'Create Purchase Payment')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">New Purchase Payment</h1>

    <form action="{{ route('purchase_payments.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Purchase Invoice Selection -->
            <div class="form-group mb-4">
                <label for="purchase_invoice_id" class="block text-gray-700 font-medium">Purchase Invoice</label>
                <select name="purchase_invoice_id" id="purchase_invoice_id" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Invoice</option>
                    @foreach($purchaseInvoices as $invoice)
                        <option value="{{ $invoice->id }}" data-total="{{ $invoice->total_amount }}" data-supplier-id="{{ $invoice->supplier->id ?? '' }}" 
                            data-invoice-date="{{ $invoice->invoice_date }}"
                            {{ old('purchase_invoice_id') == $invoice->id ? 'selected' : '' }}>
                            {{ $invoice->invoice_number }} - {{ $invoice->supplier->name ?? 'N/A' }} - {{ $invoice->total_amount }}
                        </option> 
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="supplier_id" class="block text-gray-700 font-medium">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Payment Date -->
            <div class="form-group mb-4">
                <label for="date" class="block text-gray-700 font-medium">Payment Date</label>
                <input type="date" name="date" id="date" class="form-control mt-1 block w-full" required>
            </div>

            <!-- Payment Amount -->
            <div class="form-group mb-4">
                <label for="amount" class="block text-gray-700 font-medium">Paid Amount</label>
                <input type="number" name="amount" id="amount" class="form-control mt-1 block w-full" step="0.01" min="0" required>
            </div>

            <!-- Round Off -->
            <div class="form-group mb-4">
                <label for="round_off" class="block text-gray-700 font-medium">Round Off</label>
                <input type="number" name="round_off" id="round_off" class="form-control mt-1 block w-full" step="0.01">
            </div>

            <!-- Total Amount -->
            <div class="form-group mb-4">
                <label for="total_amount" class="block text-gray-700 font-medium">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control mt-1 block w-full" step="0.01" min="0" readonly>
            </div>

            <!-- Balance Due -->
            <div class="form-group mb-4">
                <label for="balance_due" class="block text-gray-700 font-medium">Balance Due</label>
                <input type="number" name="balance_due" id="balance_due" class="form-control mt-1 block w-full" step="0.01" min="0" readonly>
            </div>

            <!-- Payment Method -->
            <div class="form-group mb-4">
                <label for="payment_method" class="block text-gray-700 font-medium">Payment Method</label>
                <select name="payment_method" id="payment_method" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Payment Method</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Cheque">Cheque</option>
                </select>
            </div>

            <!-- Payment Status -->
            <div class="form-group mb-4">
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <select name="status" id="status" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-start mt-6">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded mr-2">Save Payment</button>
            <a href="{{ route('purchase_payments.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const purchaseInvoiceSelect = document.getElementById("purchase_invoice_id");
        const supplierSelect = document.getElementById("supplier_id");
        const totalAmountInput = document.getElementById("total_amount");
        const balanceDueInput = document.getElementById("balance_due");
        const amountInput = document.getElementById("amount");
        const roundOffInput = document.getElementById("round_off");
        const invoiceDateInput = document.getElementById("invoice_date"); // Add this for invoice date

        // Function to update balance due
        function updateBalanceDue() {
            let totalAmount = parseFloat(totalAmountInput.value) || 0;
            let amountPaid = parseFloat(amountInput.value) || 0;
            let roundOff = parseFloat(roundOffInput.value) || 0;

            let balanceDue = totalAmount - amountPaid + roundOff;
            balanceDueInput.value = balanceDue.toFixed(2);
        }

        // When an invoice is selected, set the total amount, supplier, and invoice date
        purchaseInvoiceSelect.addEventListener("change", function () {
            let selectedOption = this.options[this.selectedIndex];
            let totalAmount = selectedOption.getAttribute("data-total") || 0;
            let supplierId = selectedOption.getAttribute("data-supplier-id") || "";
            let invoiceDate = selectedOption.getAttribute("data-invoice-date") || "";

            totalAmountInput.value = parseFloat(totalAmount).toFixed(2);
            balanceDueInput.value = parseFloat(totalAmount).toFixed(2); // Set balance due initially
            supplierSelect.value = supplierId; // Set the supplier
            invoiceDateInput.value = invoiceDate; // Set the invoice date
        });

        // When amount is entered, update balance due
        amountInput.addEventListener("input", updateBalanceDue);
        roundOffInput.addEventListener("input", updateBalanceDue);
    });
</script>

@endsection
