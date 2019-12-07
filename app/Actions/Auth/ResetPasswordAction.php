<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\DataTransferObjects\Auth\ResetPasswordData;

class ResetPasswordAction
{
    public function execute(ResetPasswordData $data): void
    {
        $this->guarPasswordResetToken($data->email, $data->token);

        $user = User::whereEmail($data->email)->firstOrFail();
        $user->update(['password' => Hash::make($data->password)]);

        PasswordReset::whereEmail($data->email)->delete();
    }

    protected function guarPasswordResetToken($email, $token): void
    {
        abort_if(
            PasswordReset::where(compact('email', 'token'))->count() !== 1,
            Response::HTTP_FORBIDDEN,
            'Invalid token for given email.'
        );
    }
}
