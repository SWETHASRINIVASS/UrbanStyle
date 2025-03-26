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
use App\Http\Controllers\SalePaymentController;
use App\Http\Controllers\PurchasePaymentController;
use App\Http\Controllers\SaleReturnController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

Route::resource('users', UserController::class);
Route::resource('purchases', PurchaseInvoiceController::class);

Route::put('/sales/{sale}', [SaleInvoiceController::class, 'update'])->name('sales.update');

// payments, invoice, returns routes

Route::post('/sales/{id}/payments', [SaleInvoiceController::class, 'storePayment'])->name('sales.storePayment');
Route::post('/sales/{id}/returns', [SaleInvoiceController::class, 'storeReturn'])->name('sales.storeReturn');
Route::post('/sales/{id}/items', [SaleInvoiceController::class, 'storeReturnItem'])->name('sales.storeReturnItem');

Route::post('purchases/{id}/payments', [PurchaseInvoiceController::class, 'storePayment'])->name('purchaseInvoices.storePayment');
Route::post('purchases/{id}/returns', [PurchaseInvoiceController::class, 'storeReturn'])->name('purchaseInvoices.storeReturn');
Route::post('purchases/{id}/items', [PurchaseInvoiceController::class, 'storeReturnItem'])->name('purchaseReturns.storeReturnItem');


Route::resource('sale_invoices', SaleInvoiceController::class);
Route::resource('sale_payments', SalePaymentController::class);
Route::resource('sale_returns', SaleReturnController::class);
Route::resource('purchase_invoices', PurchaseInvoiceController::class);
Route::resource('purchase_payments', PurchasePaymentController::class);
Route::resource('purchase_returns', PurchaseReturnController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/products/{id}', [ProductController::class, 'getProduct'])->name('products.get');
Route::get('/products-price/{id}', [ProductController::class, 'getProductPrice']);

// print invoice routes

Route::get('/sales/{id}/print', [SaleInvoiceController::class, 'generatePdf'])->name('sales.pdf');
Route::get('/purchases/{id}/print', [PurchaseInvoiceController::class, 'generatePdf'])->name('purchases.pdf');