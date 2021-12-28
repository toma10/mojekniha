<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\GenreRequest;
use Spatie\DataTransferObject\DataTransferObject;

class GenreData extends DataTransferObject
{
    public static function fromRequest(GenreRequest $request): self
    {
        return new self($request->validated());
    }

    public string $name;
}
