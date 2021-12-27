<?php

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\ReadingListItem;
use App\Domain\User\Models\User;
use Faker\Generator as Faker;

$factory->define(ReadingListItem::class, function (Faker $faker) {
    return [
        'book_id' => factory(Book::class),
        'user_id' => factory(User::class),
        'notes' => null,
    ];
});
