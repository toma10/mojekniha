<?php

use App\Models\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'birth_date' => $faker->date(),
        'death_date' => $faker->date(),
        'biography' => $faker->sentence,
    ];
});
