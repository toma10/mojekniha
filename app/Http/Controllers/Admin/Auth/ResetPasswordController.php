<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Domain\Auth\Actions\ResetPasswordAction;
use App\Domain\Auth\DataTransferObjects\ResetPasswordData;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResetPasswordController
{
    public function index(string $token): Response
    {
        return Inertia::render('Auth/ResetPassword', compact('token'));
    }

    public function store(ResetPasswordRequest $request, ResetPasswordAction $resetPasswordAction): RedirectResponse
    {
        try {
            $resetPasswordAction->execute(ResetPasswordData::fromRequest($request));

            flash()->success(trans('passwords.reset'));

            return redirect()->route('admin.auth.login');
        } catch (HttpException $exception) {
            flash()->error(trans('passwords.invalid'));

            return redirect()->back();
        }
    }
}
