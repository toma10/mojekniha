<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Domain\Auth\Actions\RequestPasswordResetAction;
use App\Domain\Auth\DataTransferObjects\RequestPasswordResetData;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ForgotPasswordController
{
    public function index(): Response
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    public function store(
        ForgotPasswordRequest $request,
        RequestPasswordResetAction $requestPasswordResetAction
    ): RedirectResponse {
        $requestPasswordResetAction->execute(
            new RequestPasswordResetData([
                'email' => $request->input('email'),
                'reset_password_url' => 'admin.auth.password.reset',
            ])
        );

        flash()->success(trans('passwords.sent'));

        return back();
    }
}
