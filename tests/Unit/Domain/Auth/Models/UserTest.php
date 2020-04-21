<?php

namespace Tests\Unit\Domain\Auth\Models;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_find_user_by_email()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $foundUser = User::findByEmail('johndoe@example.com');

        $this->assertTrue($foundUser->is($user));
    }

    /** @test */
    public function it_returns_avatar_url()
    {
        $user = factory(User::class)->make(['email' => 'johndoe@example.com']);
        $emailMd5 = md5('johndoe@example.com');

        $this->assertEquals("https://www.gravatar.com/avatar/${emailMd5}?d=mp&s=150", $user->avatarUrl(150));
        $this->assertEquals("https://www.gravatar.com/avatar/${emailMd5}?d=mp&s=300", $user->avatarUrl(300));
        $this->assertEquals("https://www.gravatar.com/avatar/${emailMd5}?d=mp&s=150", $user->avatarUrl);
    }

    /** @test */
    public function it_can_determine_if_is_admin()
    {
        $user = factory(User::class)->create(['is_admin' => false]);
        $admin = factory(User::class)->create(['is_admin' => true]);

        $this->assertFalse($user->isAdmin());
        $this->assertTrue($admin->isAdmin());
    }

    /** @test */
    public function it_can_determine_if_has_verified_email()
    {
        $unverifiedUser = factory(User::class)->create(['email_verified_at' => null]);
        $verifiedUser = factory(User::class)->create(['email_verified_at' => now()]);

        $this->assertFalse($unverifiedUser->hasVerifiedEmail());
        $this->assertFalse($unverifiedUser->is_verified);
        $this->assertTrue($verifiedUser->hasVerifiedEmail());
        $this->assertTrue($verifiedUser->is_verified);
    }
}
