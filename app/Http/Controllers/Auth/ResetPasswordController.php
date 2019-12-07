<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Response;
use App\Actions\Auth\ResetPasswordAction;
use App\Actions\Auth\RequestPasswordResetAction;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\DataTransferObjects\Auth\ResetPasswordData;
use App\DataTransferObjects\Auth\RequestPasswordResetData;

class ResetPasswordController
{
    public function __invoke(
        ResetPasswordRequest $request,
        RequestPasswordResetAction $requestPasswordResetAction,
        ResetPasswordAction $resetPasswordAction
    ) {
        if ($request->has('token')) {
            $resetPasswordAction->execute(
                new ResetPasswordData([
                    'email' => $request->email,
                    'token' => $request->token,
                    'password' => $request->password,
                ])
            );

            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        $requestPasswordResetAction->execute(
            new RequestPasswordResetData([
                'email' => $request->email,
                'reset_password_url' => $request->reset_password_url,
            ])
        );

        return response()->json([], Response::HTTP_ACCEPTED);
    }
}
