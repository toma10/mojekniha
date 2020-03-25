<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Domain\Auth\Actions\LoginWebAction;
use App\Domain\Auth\DataTransferObjects\LoginData;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LoginController
{
    public function index(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function store(LoginRequest $request, LoginWebAction $loginAction): RedirectResponse
    {
        $loginAction->execute(
            new LoginData($request->validated())
        );

        return redirect()->route('admin.dashboard');
    }
}
