<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Events\Auth\EmailVerified;
use App\DataTransferObjects\Auth\VerifyEmailData;
use Illuminate\Auth\Access\AuthorizationException;

class VerifyEmailAction
{
    public function execute(User $user, VerifyEmailData $verifyEmailData): void
    {
        if (!hash_equals((string) $verifyEmailData->id, (string) $user->id)) {
            throw new AuthorizationException;
        }

        if (!hash_equals((string) $verifyEmailData->hash, sha1($user->email))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->update(['email_verified_at' => now()]);
        event(new EmailVerified($user));
    }
}
