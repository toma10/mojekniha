<?php

use App\Models\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name' => 'Joseph Heller',
        'birth_date' => '1923-05-01',
        'death_date' => '1999-12-12',
        'biography' => 'Psal satirická díla, zejména novely a dramata.',
    ];
});
