<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class BookBindingData extends DataTransferObject
{
    /** @var string */
    public $name;
}
