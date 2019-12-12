<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeController
{
    public function __invoke(Request $request): JsonResource
    {
        return new UserResource($request->user());
    }
}
