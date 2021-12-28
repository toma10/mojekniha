<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\SeriesRequest;
use Spatie\DataTransferObject\DataTransferObject;

class SeriesData extends DataTransferObject
{
    public static function fromRequest(SeriesRequest $request): self
    {
        return new self([
            'name' => $request->name,
            'author_id' => (int) $request->author_id,
        ]);
    }

    public string $name;

    public int $author_id;
}
