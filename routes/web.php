<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::view('/login', 'pages.auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::view('/', 'pages.admin.dashboard')->name('admin.dashboard');

});
