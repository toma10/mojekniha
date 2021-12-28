<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\UpdateReadingListItemRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateReadingListItemData extends DataTransferObject
{
    public static function fromRequest(UpdateReadingListItemRequest $request): self
    {
        return new self($request->validated());
    }

    public ?int $rating;

    public ?string $notes;
}
