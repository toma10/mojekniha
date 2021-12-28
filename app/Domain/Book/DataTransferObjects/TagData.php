<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\TagRequest;
use Spatie\DataTransferObject\DataTransferObject;

class TagData extends DataTransferObject
{
    public static function fromRequest(TagRequest $request): self
    {
        return new self($request->validated());
    }

    public string $name;
}
