<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_book()
    {
        $book = factory(Book::class)->create();

        $response = $this->deleteJson("api/books/{$book->id}");

        $response->assertOk();
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->deleteJson('api/books/999');

        $response->assertNotFound();
    }
}
