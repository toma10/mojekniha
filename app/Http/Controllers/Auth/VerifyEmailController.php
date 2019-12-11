<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Response;
use App\Actions\Auth\VerifyEmailAction;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\DataTransferObjects\Auth\VerifyEmailData;

class VerifyEmailController
{
    public function __invoke(VerifyEmailRequest $request, VerifyEmailAction $verifyEmailAction)
    {
        $verifyEmailAction->execute(
            $request->user(),
            new VerifyEmailData($request->validated())
        );

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
