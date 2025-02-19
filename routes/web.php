<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PurchaseInvoiceController;
use App\Http\Controllers\SaleInvoiceController;
use App\Http\Controllers\TaxController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
 
// controllers routes 

Route::resource('categories', CategoryController::class);
Route::resource('customers', CustomerController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('products', ProductController::class);
Route::resource('expenses', ExpenseController::class);
Route::resource('purchases', PurchaseInvoiceController::class);
Route::resource('sales', SaleInvoiceController::class);
Route::resource('taxes', TaxController::class);

// payments routes

Route::post('/sales/{id}/payments', [SaleInvoiceController::class, 'storePayment']);
Route::post('/purchases/{id}/payments', [PurchaseInvoiceController::class, 'storePayment']);



