<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_book()
    {
        $book = factory(Book::class)->create();

        $response = $this->deleteJson("api/books/{$book->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
