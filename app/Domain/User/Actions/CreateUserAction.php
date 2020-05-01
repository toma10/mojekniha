<?php

namespace App\Domain\User\Actions;

use App\Domain\User\DataTransferObjects\CreateUserData;
use App\Domain\User\Events\UserCreated;
use App\Domain\User\Models\User;
use Facades\App\Domain\Auth\Support\PasswordGenerator;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function execute(CreateUserData $userData): User
    {
        $password = PasswordGenerator::generate();

        $user = User::create(
            array_merge($userData->all(), ['password' => Hash::make($password)])
        );

        event(new UserCreated($user, $password));

        return $user;
    }
}
