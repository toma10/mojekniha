<?php

namespace App\Http\Controllers\Admin\Auth;

use Inertia\Inertia;

class LoginController
{
    public function index()
    {
        return Inertia::render('Auth/Login');
    }
}
