<?php

use App\Domain\Auth\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->unique()->word,
        'email' => $faker->unique()->safeEmail,
        'is_admin' => false,
        'email_verified_at' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'admin', [
    'is_admin' => true,
]);

$factory->state(User::class, 'verified', [
    'email_verified_at' => now(),
]);
