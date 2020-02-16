<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class SeriesData extends DataTransferObject
{
    public string $name;

    public int $author_id;
}
