<?php

use App\Models\Author;
use App\Models\Series;
use Faker\Generator as Faker;

$factory->define(Series::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'author_id' => factory(Author::class),
    ];
});
