<?php

namespace App\Domain\User\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\User\Models\Traits\HasReadingListItems;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, Notifiable, HasReadingListItems;

    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string,string> */
    protected $casts = [
        'is_admin' => 'bool',
        'email_verified_at' => 'datetime',
    ];

    /** @var array<string> */
    protected $appends = [
        'avatar_url',
        'is_verified',
    ];

    public static function findByEmail(string $email): User
    {
        return User::where(['email' => $email])->firstOrFail();
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array<string>
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatarUrl();
    }

    public function avatarUrl(int $size = 150): string
    {
        return sprintf(
            '%s/%s?d=mp&s=%s',
            'https://www.gravatar.com/avatar',
            md5(strtolower(trim($this->email))),
            $size
        );
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function getIsVerifiedAttribute(): bool
    {
        return $this->hasVerifiedEmail();
    }

    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null;
    }
}
