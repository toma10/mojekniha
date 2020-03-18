<?php

use App\Http\Controllers\Admin\Auth\LoginController;

Route::get('/', static function () {
    return response()->json(['status' => 'OK']);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('auth/login', [LoginController::class, 'index'])->name('auth.login');
});
