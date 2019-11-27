<?php

use App\Models\Book;
use App\Models\Edition;
use App\Models\Language;
use Faker\Generator as Faker;

$factory->define(Edition::class, function (Faker $faker) {
    return [
        'book_id' => factory(Book::class),
        'isbn' => $faker->isbn13,
        'release_year' => $faker->numberBetween(1800, 2000),
        'language_id' => factory(Language::class),
        'number_of_pages' => $faker->numberBetween(100, 500),
        'number_of_copies' => $faker->numberBetween(1000, 10000),
    ];
});
