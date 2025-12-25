<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('auth.auth-master');
})->name('login');

Route::get('/register', function () {
    return view('auth.auth-master');
})->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::view('/', 'admin.dashboard')->name('admin.dashboard');
});
