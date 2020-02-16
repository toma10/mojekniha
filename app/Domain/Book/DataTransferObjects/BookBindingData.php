<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class BookBindingData extends DataTransferObject
{
    public string $name;
}
