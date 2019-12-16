<?php

use App\Domain\Book\Models\Genre;
use Faker\Generator as Faker;

$factory->define(Genre::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
