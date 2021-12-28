<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\CreateReadingListItemRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateReadingListItemData extends DataTransferObject
{
    public static function fromRequest(CreateReadingListItemRequest $request): self
    {
        return new self([
            'book_id' => (int) $request->book_id,
        ]);
    }

    public int $book_id;
}
