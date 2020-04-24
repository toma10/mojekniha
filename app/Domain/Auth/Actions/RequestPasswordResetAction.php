<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\RequestPasswordResetData;
use App\Domain\Auth\Models\PasswordReset;
use App\Domain\User\Models\User;
use App\Domain\Auth\Notifications\ResetPasswordNotification;
use Facades\App\Domain\Auth\Support\PasswordResetTokenGenerator;
use Illuminate\Support\Facades\Route;

class RequestPasswordResetAction
{
    public function execute(RequestPasswordResetData $data): void
    {
        $token = PasswordResetTokenGenerator::generate();

        $user = User::findByEmail($data->email);

        PasswordReset::create([
            'email' => $user->email,
            'token' => $token,
        ]);

        $user->notify(new ResetPasswordNotification(
            $this->buildResetPasswordUrl($data->reset_password_url, $token)
        ));
    }

    protected function buildResetPasswordUrl(string $url, string $token): string
    {
        return Route::has($url)
            ? route($url, $token)
            : sprintf('%s/%s', rtrim($url, '/'), $token);
    }
}
