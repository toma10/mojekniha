<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class MeController
{
    public function __invoke(Request $request)
    {
        return new UserResource($request->user());
    }
}
