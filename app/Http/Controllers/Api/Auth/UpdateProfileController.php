<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Book\Actions\UpdateProfileAction;
use App\Domain\Book\DataTransferObjects\ProfileData;
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
