<?php

namespace Tests;

use App\Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
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
    }

    public function login(User $user): self
    {
        auth()->login($user);

        return $this;
    }
}
