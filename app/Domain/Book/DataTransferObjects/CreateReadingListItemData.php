<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class CreateReadingListItemData extends DataTransferObject
{
    public int $book_id;
}
