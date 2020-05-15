<?php

namespace Tests\Unit\Domain\User\Support;

use App\Domain\User\Support\PasswordGenerator;
use Tests\TestCase;

class PasswordGeneratorTest extends TestCase
{
    /** @test */
    public function must_be_16_characters_long()
    {
        $generator = new PasswordGenerator();

        $password = $generator->generate();

        $this->assertEquals(16, strlen($password));
    }

    /** @test */
    public function can_only_contain_letters_and_numbers()
    {
        $generator = new PasswordGenerator();

        $password = $generator->generate();

        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $password);
    }

    /** @test */
    public function passwords_must_be_unique()
    {
        $generator = new PasswordGenerator();

        $passwords = array_map(function ($i) use ($generator) {
            return $generator->generate();
        }, range(1, 100));

        $this->assertCount(100, array_unique($passwords));
    }
}
