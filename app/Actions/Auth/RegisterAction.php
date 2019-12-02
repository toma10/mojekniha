<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\DataTransferObjects\Auth\RegisterData;

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

        event(new Registered($user));

        return auth()->login($user);
    }
}
