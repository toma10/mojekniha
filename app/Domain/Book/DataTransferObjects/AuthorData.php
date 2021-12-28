<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\AuthorRequest;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class AuthorData extends DataTransferObject
{
    public static function fromRequest(AuthorRequest $request): self
    {
        return new self([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
            'biography' => $request->biography,
            'portrait_image' => $request->portrait_image,
            'nationality_id' => (int) $request->nationality_id,
        ]);
    }

    public string $name;

    public string $birth_date;

    public ?string $death_date;

    public ?string $biography;

    public ?UploadedFile $portrait_image;

    public int $nationality_id;
}
