<?php

use App\Models\BookBinding;
use Faker\Generator as Faker;

$factory->define(BookBinding::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});
