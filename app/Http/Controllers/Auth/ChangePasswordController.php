<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ChangePasswordAction;
use App\DataTransferObjects\PasswordData;
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
