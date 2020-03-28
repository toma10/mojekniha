<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Assert;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Collection::macro('assertContains', function (...$values) {
            collect($values)->each(function ($value) {
                Assert::assertTrue(
                    $this->contains($value),
                    'Failed asserting that the collection contains the specified value.'
                );
            });
        });

        TestResponse::macro('assertSessionHasFlashMessage', function (?string $level) {
            Assert::assertNotEmpty(flash()->message, 'Session is missing flash message.');

            $actualLevel = flash()->level;

            if ($level) {
                Assert::assertEquals($level, $actualLevel, "Expected '${level}' flash message level, but got '${actualLevel}'.");
            }
        });
    }
}
