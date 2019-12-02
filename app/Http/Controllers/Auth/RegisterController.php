<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\TokenResource;
use App\Http\Requests\Auth\RegisterRequest;
use App\DataTransferObjects\Auth\RegisterData;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterAction $registerAction)
    {
        $token = $registerAction->execute(
            new RegisterData($request->validated())
        );

        return new TokenResource($token);
    }
}
