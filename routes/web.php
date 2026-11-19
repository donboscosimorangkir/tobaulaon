<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;

// ================== HALAMAN CUSTOMER ==================
Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{code}', [BookingController::class, 'success'])->name('booking.success');
Route::get('/cek-pesanan', [BookingController::class, 'checkStatusForm'])->name('booking.check');
Route::post('/cek-pesanan', [BookingController::class, 'checkStatus'])->name('booking.check.submit');
Route::get('/produk/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/paket', [PackageController::class, 'index'])->name('package.index');
Route::get('/paket/{package}', [PackageController::class, 'show'])->name('package.show');

// ================== LOGIN ADMIN ==================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================== PANEL ADMIN (harus login) ==================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('vendor', \App\Http\Controllers\Admin\VendorController::class)->except(['show']);
Route::resource('layanan', \App\Http\Controllers\Admin\ServiceController::class)->except(['show']);
Route::resource('paket', \App\Http\Controllers\Admin\PackageController::class)->except(['show']);

    Route::get('/produk', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/produk/tambah', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/produk', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/produk/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/produk/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/produk/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/booking', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/booking/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::patch('/booking/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.status');
    Route::post('/booking/{booking}/pembayaran', [AdminBookingController::class, 'storePayment'])->name('bookings.payment');
});
