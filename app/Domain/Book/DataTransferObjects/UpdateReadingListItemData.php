<?php

namespace App\Domain\Book\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateReadingListItemData extends DataTransferObject
{
    public ?string $notes;
}
