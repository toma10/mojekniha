<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_book()
    {
        $book = factory(Book::class)->create();
        $data = $this->getValidParams();

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $book['id'],
                'name' => $data['name'],
                'original_name' => $data['original_name'],
                'description' => $data['description'],
                'release_year' => $data['release_year'],
            ],
        ]);
    }


    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $book = factory(Book::class)->create();

        $response = $this->putJson('api/books/999', []);

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $book = factory(Book::class)->create();
        $data = $this->getValidParams(['name' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_an_original_name()
    {
        $book = factory(Book::class)->create();
        $data = $this->getValidParams(['original_name' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('original_name');
    }

    /** @test */
    public function it_requires_a_description()
    {
        $book = factory(Book::class)->create();
        $data = $this->getValidParams(['description' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('description');
    }

    /** @test */
    public function it_requires_a_release_year()
    {
        $book = factory(Book::class)->create();
        $data = $this->getValidParams(['release_year' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_numeric()
    {
        $book = factory(Book::class)->create();
        $data = $this->getValidParams(['release_year' => 'not-a-valid-number']);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_positive()
    {
        $book = factory(Book::class)->create();
        $data = $this->getValidParams(['release_year' => -1]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    private function getValidParams(array $overrides = []): array
    {
        return array_merge([
            'name' => '1984',
            'original_name' => 'Nineteen Eighty-Four',
            'description' => '1984, dnes již klasické dílo antiutopického žánru, je bezesporu jedním z nejpozoruhodnějších románů 20. století a brilantní analýzou všech totalitních systémů.',
            'release_year' => 1949,
        ], $overrides);
    }
}
