<?php

use App\Models\Language;
use Faker\Generator as Faker;

$factory->define(Language::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});
