<?php

namespace App\Http\Controllers\Api\Auth;

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
        $resendEmailVerificationAction->execute($request->user(), ResendEmailVerificationData::fromRequest($request));

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
