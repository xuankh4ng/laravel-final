<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('pages.admin.dashboard');
    });
});
