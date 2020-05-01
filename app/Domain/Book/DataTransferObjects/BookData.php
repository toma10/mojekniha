<?php

namespace App\Domain\Book\DataTransferObjects;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class BookData extends DataTransferObject
{
    public string $name;

    public string $original_name;

    public string $description;

    public int $release_year;

    public ?UploadedFile $cover_image;

    public int $author_id;

    public ?int $series_id;

    /** @var array<mixed>|null */
    public ?array $genres;

    /** @var array<mixed>|null */
    public ?array $tags;
}
