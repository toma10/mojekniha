<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\BookBinding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteBookBindingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_book_binding()
    {
        $bookBinding = factory(BookBinding::class)->create();

        $response = $this->deleteJson("api/book-bindings/{$bookBinding->id}");

        $response->assertOk();
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->deleteJson('api/book-bindings/999');

        $response->assertNotFound();
    }
}
