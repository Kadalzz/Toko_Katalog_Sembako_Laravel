<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicController;

// Public Routes (Tidak Perlu Login - Untuk Customer)
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/produk/{id}', [PublicController::class, 'show'])->name('public.show');
Route::get('/checkout/{id}', [PublicController::class, 'checkout'])->name('public.checkout');
Route::post('/order', [PublicController::class, 'order'])->name('public.order');
Route::get('/success/{id}', [PublicController::class, 'success'])->name('public.success');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes (Memerlukan Login - Untuk Admin)
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes untuk Category, Product, dan Transaction
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);
});
