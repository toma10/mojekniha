<?php

use App\Domain\Auth\Models\PasswordReset;
use Faker\Generator as Faker;

$factory->define(PasswordReset::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'token' => $faker->word,
    ];
});
