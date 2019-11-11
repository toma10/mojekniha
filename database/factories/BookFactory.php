<?php

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => 'Hlava XXII',
        'original_name' => 'Catch-22',
        'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
        'release_year' => 1961,
    ];
});
