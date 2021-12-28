<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\BookBindingRequest;
use Spatie\DataTransferObject\DataTransferObject;

class BookBindingData extends DataTransferObject
{
    public static function fromRequest(BookBindingRequest $request): self
    {
        return new self($request->validated());
    }

    public string $name;
}
