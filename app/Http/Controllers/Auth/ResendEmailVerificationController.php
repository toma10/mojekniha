<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResendEmailVerificationController
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate(['verify_email_url' => ['required', 'url']]);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
