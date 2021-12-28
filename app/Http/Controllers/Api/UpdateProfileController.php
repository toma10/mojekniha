<?php

namespace App\Http\Controllers\Api;

use App\Domain\User\Actions\UpdateUserAction;
use App\Domain\User\DataTransferObjects\UpdateUserData;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateProfileController
{
    public function __invoke(UpdateUserRequest $request, UpdateUserAction $updateUserAction): JsonResource
    {
        $user = $updateUserAction->execute(
            $request->user(),
            UpdateUserData::fromRequest($request)
        );

        return new UserResource($user);
    }
}
