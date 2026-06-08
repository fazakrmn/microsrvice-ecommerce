<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/products', [HomeController::class, 'addProduct'])->name('products.add');
Route::post('/cart', [HomeController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout', [HomeController::class, 'checkout'])->name('cart.checkout');
