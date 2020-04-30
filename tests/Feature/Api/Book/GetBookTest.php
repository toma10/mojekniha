<?php

namespace Tests\Feature\Api\Book;

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
                'release_year' => $book->release_year,
                'cover_url' => url(Book::FALLBACK_COVER_IMAGE),
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
