<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class GenreData extends DataTransferObject
{
    /** @var string */
    public $name;
}
