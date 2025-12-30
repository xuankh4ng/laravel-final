<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UI\ProductController as UIProductController;

Route::get('/', function () {return view('layouts.home');})->name('home');
Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::get('/products', [UIProductController::class, 'index'])->name('products');
Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function() {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('orders', OrdersController::class)->except(['create', 'store']);
});
