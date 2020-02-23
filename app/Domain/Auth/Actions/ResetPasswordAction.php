<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\ResetPasswordData;
use App\Domain\Auth\Models\User;
use App\Domain\Auth\Models\PasswordReset;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ResetPasswordAction
{
    public function execute(ResetPasswordData $data): void
    {
        $this->guardPasswordResetToken($data->email, $data->token);

        $user = User::findByEmail($data->email);
        $user->update(['password' => Hash::make($data->password)]);

        PasswordReset::where(['email' => $data->email])->delete();
    }

    protected function guardPasswordResetToken(string $email, string $token): void
    {
        abort_if(
            PasswordReset::where(compact('email', 'token'))->count() !== 1,
            Response::HTTP_FORBIDDEN,
            'Invalid token for given email.'
        );
    }
}
