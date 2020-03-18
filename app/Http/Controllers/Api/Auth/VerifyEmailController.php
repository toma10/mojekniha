<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Auth\Actions\VerifyEmailAction;
use App\Domain\Auth\DataTransferObjects\VerifyEmailData;
use App\Http\Requests\Auth\VerifyEmailRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VerifyEmailController
{
    public function __invoke(VerifyEmailRequest $request, VerifyEmailAction $verifyEmailAction): JsonResponse
    {
        $verifyEmailAction->execute(
            $request->user(),
            new VerifyEmailData($request->validated())
        );

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
