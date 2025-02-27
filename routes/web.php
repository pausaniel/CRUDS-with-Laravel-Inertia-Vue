<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Home Route //
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product Routes //
Route::resource('products', ProductController::class)->except(['show']);

// Cart Routes //
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('cart', [CartController::class, 'index'])->name('cart');

// Dashboard Route //
Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');

require __DIR__ . '/auth.php';