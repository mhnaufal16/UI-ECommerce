<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — AP Kreasi Reklame & Neon Box (UI Only)
|--------------------------------------------------------------------------
*/

// ─── User / Public Routes ────────────────────────────────────────────────────
Route::get('/', fn() => view('pages.user.landing'))->name('home');
Route::get('/produk', fn() => view('pages.user.catalog'))->name('catalog');
Route::get('/kalkulator', fn() => view('pages.user.calculator'))->name('calculator');
Route::get('/checkout', fn() => view('pages.user.checkout'))->name('checkout');
Route::get('/dashboard', fn() => view('pages.user.dashboard'))->name('user.dashboard');
Route::get('/dashboard/orders/{id}', fn($id) => view('pages.user.order-detail', ['orderId' => $id]))->name('user.order-detail');
Route::get('/tentang', fn() => view('pages.user.tentang'))->name('about');

// ─── Admin Routes ─────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('pages.admin.dashboard'))->name('dashboard');
    Route::get('/orders', fn() => view('pages.admin.orders.index'))->name('orders.index');
    Route::get('/orders/{id}', fn($id) => view('pages.admin.orders.show', ['orderId' => $id]))->name('orders.show');
    Route::get('/products', fn() => view('pages.admin.products.index'))->name('products.index');
    Route::get('/promos', fn() => view('pages.admin.promos.index'))->name('promos.index');
    Route::get('/pricing', fn() => view('pages.admin.pricing.index'))->name('pricing.index');
});
