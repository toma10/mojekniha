<?php

namespace Tests\Unit\Domain\Auth\Support;

use App\Domain\Auth\Support\PasswordResetTokenGenerator;
use Tests\TestCase;

class PasswordResetTokenGeneratorTest extends TestCase
{
    /** @test */
    public function must_be_128_characters_long()
    {
        $generator = new PasswordResetTokenGenerator();

        $token = $generator->generate();

        $this->assertEquals(128, strlen($token));
    }

    /** @test */
    public function can_only_contain_letters_and_numbers()
    {
        $generator = new PasswordResetTokenGenerator();

        $token = $generator->generate();

        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $token);
    }

    /** @test */
    public function passwords_must_be_unique()
    {
        $generator = new PasswordResetTokenGenerator();

        $tokens = array_map(function ($i) use ($generator) {
            return $generator->generate();
        }, range(1, 100));

        $this->assertCount(100, array_unique($tokens));
    }
}
