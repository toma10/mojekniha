<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteAuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_author()
    {
        $author = factory(Author::class)->create();

        $response = $this->deleteJson("api/authors/{$author->id}");

        $response->assertOk();
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->deleteJson('api/authors/999');

        $response->assertNotFound();
    }
}
