<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\RegisterData;
use App\Domain\Auth\Events\Registered;
use App\Domain\Auth\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    public function execute(RegisterData $registerData): string
    {
        $user = User::create([
            'name' => $registerData->name,
            'username' => $registerData->username,
            'email' => $registerData->email,
            'password' => Hash::make($registerData->password),
        ]);

        event(new Registered($user, $registerData->verify_email_url));

        return auth()->login($user);
    }
}
