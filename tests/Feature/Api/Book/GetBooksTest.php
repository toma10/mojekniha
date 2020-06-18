<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetBooksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_paginated_books()
    {
        factory(Book::class)->create();
        factory(Book::class)->create();
        factory(Book::class)->create();

        $response = $this->getJson('api/books');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'original_name',
                    'description',
                    'release_year',
                    'cover_url',
                ],
            ],
            'meta' => [
                'links' => [
                    'pages' => [],
                    'previous',
                    'next',
                ],
            ],
        ]);
    }
}
