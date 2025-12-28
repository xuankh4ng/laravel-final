<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Categories
    Route::get('/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');

    // Orders
    Route::view('/orders', 'admin.orders')->name('admin.orders');

    // Users
    Route::view('/users', 'admin.users')->name('admin.users');
});
