<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Auth\Actions\ResetPasswordAction;
use App\Domain\Auth\DataTransferObjects\ResetPasswordData;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResetPasswordController
{
    public function __invoke(
        string $token,
        ResetPasswordRequest $request,
        ResetPasswordAction $resetPasswordAction
    ): JsonResponse {
        $resetPasswordAction->execute(
            new ResetPasswordData([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'token' => $token,
            ])
        );

        return response()->json([], Response::HTTP_ACCEPTED);
    }
}
