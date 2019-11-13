<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_book()
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
