<?php

namespace Tests\Unit\Models;

use App\Models\User;
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
        $this->assertTrue($verifiedUser->hasVerifiedEmail());
    }
}
