<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.home');
})->name('home');

Route::get('/login', function () {
    return view('auth.auth-master');
})->name('login');

Route::get('/register', function () {
    return view('auth.auth-master');
})->name('register');

Route::get('/products', function () {
    return view('layouts.products');
})->name('products');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::view('/', 'admin.dashboard')->name('admin.dashboard');
});
