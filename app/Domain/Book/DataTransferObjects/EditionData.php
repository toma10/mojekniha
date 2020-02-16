<?php

namespace App\Domain\Book\DataTransferObjects;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class EditionData extends DataTransferObject
{
    public int $book_id;

    public string $isbn;

    public int $release_year;

    public int $language_id;

    public int $number_of_pages;

    public int $number_of_copies;

    public int $book_binding_id;

    public ?UploadedFile $cover_image;
}
