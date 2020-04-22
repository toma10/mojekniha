<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\UserData;
use App\Domain\Auth\Events\UserCreated;
use App\Domain\Auth\Models\User;
use Facades\App\Domain\Auth\Support\PasswordGenerator;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function execute(UserData $userData): User
    {
        $password = PasswordGenerator::generate();

        $user = User::create(
            array_merge($userData->all(), ['password' => Hash::make($password)])
        );

        event(new UserCreated($user, $password));

        return $user;
    }
}
