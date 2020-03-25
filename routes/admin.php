<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('auth/login', [LoginController::class, 'index'])->name('auth.login');
Route::get('login', [LoginController::class, 'index'])->middleware('guest:web')->name('auth.login');
Route::post('login', [LoginController::class, 'store']);

Route::get('/', DashboardController::class)->middleware('auth:web')->name('dashboard');
