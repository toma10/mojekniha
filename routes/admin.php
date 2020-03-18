<?php

use App\Http\Controllers\Admin\Auth\LoginController;

Route::get('auth/login', [LoginController::class, 'index'])->name('auth.login');
