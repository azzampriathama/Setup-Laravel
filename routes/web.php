<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman toko
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produk/{category}', [ProductController::class, 'index'])->name('products.category');
Route::get('/cari', [ProductController::class, 'search'])->name('products.search');

/*
|--------------------------------------------------------------------------
| Keranjang belanja
|--------------------------------------------------------------------------
*/
Route::prefix('keranjang')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/tambah/{product}', [CartController::class, 'add'])->name('add');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::post('/hapus', [CartController::class, 'remove'])->name('remove');
    Route::post('/kosongkan', [CartController::class, 'clear'])->name('clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
});

/*
|--------------------------------------------------------------------------
| Checkout / metode pembayaran
|--------------------------------------------------------------------------
*/
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
    Route::get('/sukses/{invoice}', [CheckoutController::class, 'success'])->name('success');
});

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/masuk', [AuthController::class, 'login'])->name('login.store');

    Route::get('/admin/masuk', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin/masuk', [AuthController::class, 'adminLogin'])->name('admin.login.store');
});

Route::post('/keluar', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Area admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
