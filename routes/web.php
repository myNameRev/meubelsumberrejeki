<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\MitraController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// Admin Auth Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login')->middleware('guest:admin');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest:admin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
});

// Admin Protected Routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Categories CRUD
    Route::resource('categories', AdminCategoryController::class, ['as' => 'admin']);

    // Products CRUD
    Route::resource('products', AdminProductController::class, ['as' => 'admin']);

    // Mitraks CRUD
    Route::resource('mitraks', MitraController::class, ['as' => 'admin']);
});
