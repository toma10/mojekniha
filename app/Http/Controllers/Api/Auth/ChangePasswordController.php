<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Auth\Actions\ChangePasswordAction;
use App\Domain\Auth\DataTransferObjects\PasswordData;
use App\Http\Requests\Auth\PasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ChangePasswordController
{
    public function __invoke(PasswordRequest $request, ChangePasswordAction $changePasswordAction): JsonResponse
    {
        $changePasswordAction->execute(
            $request->user(),
            new PasswordData($request->validated())
        );

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
