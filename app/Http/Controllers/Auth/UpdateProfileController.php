<?php

namespace App\Http\Controllers\Auth;

use App\Actions\UpdateProfileAction;
use App\Http\Resources\UserResource;
use App\DataTransferObjects\ProfileData;
use App\Http\Requests\UpdateProfileRequest;

class UpdateProfileController
{
    public function __invoke(UpdateProfileRequest $request, UpdateProfileAction $updateProfileAction)
    {
        $user = $updateProfileAction->execute(
            $request->user(),
            new ProfileData($request->validated())
        );

        return new UserResource($user);
    }
}
