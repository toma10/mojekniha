<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Auth\Actions\RequestPasswordResetAction;
use App\Domain\Auth\DataTransferObjects\RequestPasswordResetData;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ForgotPasswordController
{
    public function __invoke(
        ForgotPasswordRequest $request,
        RequestPasswordResetAction $requestPasswordResetAction
    ): JsonResponse {
        $requestPasswordResetAction->execute(
            new RequestPasswordResetData(
                $request->only('email', 'reset_password_url')
            )
        );

        return response()->json([], Response::HTTP_ACCEPTED);
    }
}
