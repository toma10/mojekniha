<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UsersController;

Route::middleware('guest:web')->group(static function (): void {
    Route::get('login', [LoginController::class, 'index'])->name('auth.login');
    Route::post('login', [LoginController::class, 'store']);

    Route::get('password/reset', [ForgotPasswordController::class, 'index'])->name('auth.password.forgot');
    Route::post('password/email', [ForgotPasswordController::class, 'store'])->name('auth.password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'index'])->name('auth.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'store'])->name('auth.password.update');
});

Route::middleware(['auth:web', 'admin'])->group(static function (): void {
    Route::post('logout', LogoutController::class)->name('auth.logout');

    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [ProfileController::class, 'store']);

    Route::post('password', ChangePasswordController::class)->name('password');

    Route::resource('users', UsersController::class);
});
