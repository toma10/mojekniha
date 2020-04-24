<?php

namespace App\Http\Controllers\Api;

use App\Domain\User\Actions\ChangePasswordAction;
use App\Domain\User\DataTransferObjects\PasswordData;
use App\Http\Requests\PasswordRequest;
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
