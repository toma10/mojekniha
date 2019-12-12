<?php

namespace Tests\Unit\Models;

use App\Models\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_find_password_reset_by_email()
    {
        $passwordReset = factory(PasswordReset::class)->create([
            'email' => 'johndoe@example.com',
            'token' => 'TOKEN',
        ]);

        $foundPasswordReset = PasswordReset::findByEmail('johndoe@example.com');

        $this->assertEquals('johndoe@example.com', $foundPasswordReset->email);
        $this->assertEquals('TOKEN', $foundPasswordReset->token);
    }
}
