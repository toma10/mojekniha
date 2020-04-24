<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\DataTransferObjects\VerifyEmailData;
use App\Domain\Auth\Events\EmailVerified;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class VerifyEmailAction
{
    public function execute(User $user, VerifyEmailData $verifyEmailData): void
    {
        if (! hash_equals((string) $verifyEmailData->id, (string) $user->id)) {
            throw new AuthorizationException();
        }

        if (! hash_equals((string) $verifyEmailData->hash, sha1($user->email))) {
            throw new AuthorizationException();
        }

        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->update(['email_verified_at' => now()]);
        event(new EmailVerified($user));
    }
}
