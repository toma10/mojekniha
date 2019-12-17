<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Auth\Actions\RequestPasswordResetAction;
use App\Domain\Auth\Actions\ResetPasswordAction;
use App\Domain\Auth\DataTransferObjects\RequestPasswordResetData;
use App\Domain\Auth\DataTransferObjects\ResetPasswordData;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResetPasswordController
{
    public function __invoke(
        ResetPasswordRequest $request,
        RequestPasswordResetAction $requestPasswordResetAction,
        ResetPasswordAction $resetPasswordAction
    ): JsonResponse {
        if ($request->has('token')) {
            $resetPasswordAction->execute(
                new ResetPasswordData([
                    'email' => $request->input('email'),
                    'token' => $request->input('token'),
                    'password' => $request->input('password'),
                ])
            );

            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        $requestPasswordResetAction->execute(
            new RequestPasswordResetData([
                'email' => $request->input('email'),
                'reset_password_url' => $request->input('reset_password_url'),
            ])
        );

        return response()->json([], Response::HTTP_ACCEPTED);
    }
}
