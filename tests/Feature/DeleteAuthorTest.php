<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
