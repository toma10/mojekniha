<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Response;
use App\DataTransferObjects\PasswordData;
use App\Actions\Auth\ChangePasswordAction;
use App\Http\Requests\Auth\PasswordRequest;

class ChangePasswordController
{
    public function __invoke(PasswordRequest $request, ChangePasswordAction $changePasswordAction)
    {
        $changePasswordAction->execute(
            $request->user(),
            new PasswordData($request->validated())
        );

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
