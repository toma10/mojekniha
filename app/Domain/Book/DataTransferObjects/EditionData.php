<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\EditionRequest;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class EditionData extends DataTransferObject
{
    public static function fromRequest(EditionRequest $request): self
    {
        return new self([
            'book_id' => (int) $request->book_id,
            'isbn' => $request->isbn,
            'release_year' => (int) $request->release_year,
            'language_id' => (int) $request->language_id,
            'number_of_pages' => (int) $request->number_of_pages,
            'number_of_copies' => (int) $request->number_of_copies,
            'book_binding_id' => (int) $request->book_binding_id,
            'cover_image' => $request->cover_image,
        ]);
    }

    public int $book_id;

    public string $isbn;

    public int $release_year;

    public int $language_id;

    public int $number_of_pages;

    public int $number_of_copies;

    public int $book_binding_id;

    public ?UploadedFile $cover_image;
}
