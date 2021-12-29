<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_book_with_default_cover_url()
    {
        $book = factory(Book::class)->create();

        $response = $this->getJson("api/books/{$book->id}");

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $book->id,
                'name' => $book->name,
                'original_name' => $book->original_name,
                'description' => $book->description,
                'formatted_description' => sprintf('<p>%s</p>', $book->description),
                'release_year' => $book->release_year,
                'average_rating' => null,
                'cover_url' => url(Book::FALLBACK_COVER_IMAGE),
                'author' => [
                    'id' => $book->author->id,
                    'name' => $book->author->name,
                    'birth_date' => $book->author->birth_date->format('Y-m-d'),
                    'death_date' => $book->author->death_date->format('Y-m-d'),
                    'biography' => $book->author->biography,
                    'formatted_biography' => sprintf('<p>%s</p>', $book->author->biography),
                    'nationality' => [
                        'id' => $book->author->nationality->id,
                        'name' => $book->author->nationality->name,
                    ],
                    'portrait_url' => url(Author::FALLBACK_PORTRAIT_IMAGE),
                ],
                'series' => null,
                'genres' => [],
                'tags' => [],
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->getJson('api/books/999');

        $response->assertNotFound();
    }
}
