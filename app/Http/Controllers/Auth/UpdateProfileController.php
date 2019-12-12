<?php

namespace App\Http\Controllers\Auth;

use App\Actions\UpdateProfileAction;
use App\DataTransferObjects\ProfileData;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateProfileController
{
    public function __invoke(UpdateProfileRequest $request, UpdateProfileAction $updateProfileAction): JsonResource
    {
        $user = $updateProfileAction->execute(
            $request->user(),
            new ProfileData($request->validated())
        );

        return new UserResource($user);
    }
}
