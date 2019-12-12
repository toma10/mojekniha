<?php

namespace App\Actions\Auth;

use App\DataTransferObjects\Auth\RegisterData;
use App\Events\Auth\Registered;
use App\Models\User;
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
