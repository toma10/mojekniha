<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_book()
    {
        $data = factory(Book::class)->raw([
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
        ]);

        $response = $this->postJSon('api/books', $data);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ['id']]);
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
                'original_name' => $data['original_name'],
                'description' => $data['description'],
                'release_year' => $data['release_year'],
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $data = factory(Book::class)->raw(['name' => null]);

        $response = $this->postJSon('api/books', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_an_original_name()
    {
        $data = factory(Book::class)->raw(['original_name' => null]);

        $response = $this->postJSon('api/books', $data);

        $response->assertJsonValidationErrors('original_name');
    }

    /** @test */
    public function it_requires_a_description()
    {
        $data = factory(Book::class)->raw(['description' => null]);

        $response = $this->postJSon('api/books', $data);

        $response->assertJsonValidationErrors('description');
    }

    /** @test */
    public function it_requires_a_release_year()
    {
        $data = factory(Book::class)->raw(['release_year' => null]);

        $response = $this->postJSon('api/books', $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_numeric()
    {
        $data = factory(Book::class)->raw(['release_year' => 'not-a-valid-number']);

        $response = $this->postJSon('api/books', $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_positive()
    {
        $data = factory(Book::class)->raw(['release_year' => -1]);

        $response = $this->postJSon('api/books', $data);

        $response->assertJsonValidationErrors('release_year');
    }
}
