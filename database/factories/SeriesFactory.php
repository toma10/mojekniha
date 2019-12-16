<?php

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Series;
use Faker\Generator as Faker;

$factory->define(Series::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'author_id' => factory(Author::class),
    ];
});
