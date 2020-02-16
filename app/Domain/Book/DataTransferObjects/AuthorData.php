<?php

namespace App\Domain\Book\DataTransferObjects;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class AuthorData extends DataTransferObject
{
    public string $name;

    public string $birth_date;

    public ?string $death_date;

    public ?string $biography;

    public ?UploadedFile $portrait_image;

    public int $nationality_id;
}
