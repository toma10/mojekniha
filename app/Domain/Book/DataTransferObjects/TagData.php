<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class TagData extends DataTransferObject
{
    public string $name;
}
