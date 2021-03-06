<?php

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'original_name' => $faker->word,
        'description' => $faker->sentence,
        'release_year' => $faker->numberBetween(1800, 2000),
        'author_id' => factory(Author::class),
        'series_id' => null,
    ];
});
