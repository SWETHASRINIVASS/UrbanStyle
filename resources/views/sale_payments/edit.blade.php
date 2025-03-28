@extends('layouts.app')

@section('title', 'Edit Sale Payment')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Sale Payment</h1>

    <form action="{{ route('sale_payments.update', $salePayment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Sale Invoice Selection -->
            <div class="form-group mb-4">
                <label for="sale_invoice_id" class="block text-gray-700 font-medium">Sale Invoice</label>
                <select name="sale_invoice_id" id="sale_invoice_id" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Invoice</option>
                    @foreach($saleInvoices as $invoice)
                        <option value="{{ $invoice->id }}" 
                            data-total="{{ $invoice->total_amount }}" 
                            data-customer-id="{{ $invoice->customer->id ?? '' }}" 
                            {{ $salePayment->sale_invoice_id == $invoice->id ? 'selected' : '' }}>
                            {{ $invoice->invoice_number }} - {{ $invoice->customer->name ?? 'N/A' }} - {{ $invoice->total_amount }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Customer Selection -->
            <div class="form-group mb-4">
                <label for="customer_id" class="block text-gray-700 font-medium">Customer</label>
                <select name="customer_id" id="customer_id" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $salePayment->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Payment Date -->
            <div class="form-group mb-4">
                <label for="date" class="block text-gray-700 font-medium">Payment Date</label>
                <input type="date" name="date" id="date" class="form-control mt-1 block w-full" value="{{ $salePayment->date }}" required>
            </div>

            <!-- Payment Amount -->
            <div class="form-group mb-4">
                <label for="amount" class="block text-gray-700 font-medium">Paid Amount</label>
                <input type="number" name="amount" id="amount" class="form-control mt-1 block w-full" step="0.01" min="0" value="{{ $salePayment->amount }}" required>
            </div>

            <!-- Round Off -->
            <div class="form-group mb-4">
                <label for="round_off" class="block text-gray-700 font-medium">Round Off</label>
                <input type="number" name="round_off" id="round_off" class="form-control mt-1 block w-full" step="0.01" value="{{ $salePayment->round_off }}">
            </div>

            <!-- Total Amount -->
            <div class="form-group mb-4">
                <label for="total_amount" class="block text-gray-700 font-medium">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control mt-1 block w-full" step="0.01" min="0" value="{{ $salePayment->total_amount }}" readonly>
            </div>

            <!-- Balance Due -->
            <div class="form-group mb-4">
                <label for="balance_due" class="block text-gray-700 font-medium">Balance Due</label>
                <input type="number" name="balance_due" id="balance_due" class="form-control mt-1 block w-full" step="0.01" min="0" value="{{ $salePayment->balance_due }}" readonly>
            </div>

            <!-- Payment Method -->
            <div class="form-group mb-4">
                <label for="payment_method" class="block text-gray-700 font-medium">Payment Method</label>
                <select name="payment_method" id="payment_method" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Payment Method</option>
                    <option value="Cash" {{ $salePayment->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Card" {{ $salePayment->payment_method == 'Card' ? 'selected' : '' }}>Card</option>
                    <option value="Bank Transfer" {{ $salePayment->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="Cheque" {{ $salePayment->payment_method == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                </select>
            </div>

            <!-- Payment Status -->
            <div class="form-group mb-4">
                <label for="status" class="block text-gray-700 font-medium">Status</label>
                <select name="status" id="status" class="tom-select mt-1 block w-full" required>
                    <option value="">Select Status</option>
                    <option value="Pending" {{ $salePayment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ $salePayment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-start mt-6">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded mr-2">Update Payment</button>
            <a href="{{ route('sale_payments.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const saleInvoiceSelect = document.getElementById("sale_invoice_id");
        const customerSelect = document.getElementById("customer_id");
        const totalAmountInput = document.getElementById("total_amount");
        const balanceDueInput = document.getElementById("balance_due");
        const amountInput = document.getElementById("amount");
        const roundOffInput = document.getElementById("round_off");

        // Function to update balance due
        function updateBalanceDue() {
            let totalAmount = parseFloat(totalAmountInput.value) || 0;
            let amountPaid = parseFloat(amountInput.value) || 0;
            let roundOff = parseFloat(roundOffInput.value) || 0;

            let balanceDue = totalAmount - amountPaid + roundOff;
            balanceDueInput.value = balanceDue.toFixed(2);
        }

        // When an invoice is selected, set the total amount and customer
        saleInvoiceSelect.addEventListener("change", function () {
            let selectedOption = this.options[this.selectedIndex];
            let totalAmount = selectedOption.getAttribute("data-total") || 0;
            let customerId = selectedOption.getAttribute("data-customer-id") || "";

            totalAmountInput.value = parseFloat(totalAmount).toFixed(2);
            balanceDueInput.value = parseFloat(totalAmount).toFixed(2); // Set balance due initially
            customerSelect.value = customerId; // Set the customer
        });

        // When amount is entered, update balance due
        amountInput.addEventListener("input", updateBalanceDue);
        roundOffInput.addEventListener("input", updateBalanceDue);
    });
</script>
@endsection
