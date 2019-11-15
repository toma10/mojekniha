<?php

use App\Models\Nationality;
use Faker\Generator as Faker;

$factory->define(Nationality::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
