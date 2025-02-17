<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Controllers\SaleInvoiceController;
use App\Http\Controllers\TaxController;

//category
Route::resource('categories', CategoryController::class);

//customer
Route::resource('customers', CustomerController::class);

// suppliers
Route::resource('suppliers', SupplierController::class);

//expenses
Route::resource('expenses', ExpenseController::class);

//products
Route::resource('products', ProductController::class);

//purchase invoice
Route::resource('purchases', PurchaseInvoiceController::class);
Route::post('/purchases/{id}/payments', [PurchaseInvoiceController::class, 'storePayment']); 

//sale invoice
Route::resource('sales', SaleInvoiceController::class);
Route::post('/sales/{id}/payments', [SaleInvoiceController::class, 'storePayment']); 

//tax invoice
Route::resource('taxes', TaxController::class);

