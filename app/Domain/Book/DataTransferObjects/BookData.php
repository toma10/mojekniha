<?php

namespace App\Domain\Book\DataTransferObjects;

use App\Http\Requests\BookRequest;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class BookData extends DataTransferObject
{
    public static function fromRequest(BookRequest $request): self
    {
        return new self([
            'name' => $request->name,
            'original_name' => $request->original_name,
            'description' => $request->description,
            'release_year' => (int) $request->release_year,
            'cover_image' => $request->cover_image,
            'author_id' => (int) $request->author_id,
            'series_id' => $request->series_id ? (int) $request->series_id : null,
            'genres' => is_array($request->genres)
                ? collect($request->genres)->map(fn (string $id) => (int) $id)
                : null,
            'tags' => is_array($request->tags)
                ? collect($request->tags)->map(fn (string $id) => (int) $id)
                : null,
        ]);
    }

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
