<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Auth\Actions\ResendEmailVerificationAction;
use App\Domain\Auth\DataTransferObjects\ResendEmailVerificationData;
use App\Http\Requests\Auth\ResendEmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResendEmailVerificationController
{
    public function __invoke(
        ResendEmailVerificationRequest $request,
        ResendEmailVerificationAction $resendEmailVerificationAction
    ): JsonResponse {
        $resendEmailVerificationAction->execute(
            $request->user(),
            new ResendEmailVerificationData($request->validated())
        );

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
