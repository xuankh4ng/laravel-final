<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.home');
})->name('home');

Route::get('/products', function () {
    return view('layouts.products');
})->name('products');

Route::get('/auth', [AuthController::class, 'index'])->name('auth');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function() {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('orders', OrdersController::class)->except(['create', 'store']);
});
