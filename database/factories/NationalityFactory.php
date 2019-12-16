<?php

use App\Domain\Book\Models\Nationality;
use Faker\Generator as Faker;

$factory->define(Nationality::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});
