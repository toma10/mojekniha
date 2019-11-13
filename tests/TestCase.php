<?php

namespace Tests;

use Exception;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getValidParams(array $overrides = []): array
    {
        if (!property_exists(static::class, 'validParms')) {
            throw new Exception("You must define 'validParms' for given test");
        }

        return array_merge($this->validParms, $overrides);
    }
}
