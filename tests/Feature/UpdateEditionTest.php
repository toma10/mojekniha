<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateEditionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_edition()
    {
        $edition = factory(Edition::class)->create();
        $book = factory(Book::class)->create();
        $language = factory(Language::class)->create(['name' => 'český',]);
        $data = [
            'book_id' => $book->id,
            'isbn' => '978-80-7381-931-6',
            'release_year' => 2011,
            'language_id' => $language->id,
            'number_of_pages' => 536,
            'number_of_copies' => 1000,
        ];

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'isbn' => $data['isbn'],
                'release_year' => $data['release_year'],
                'language' => [
                    'id' => $language->id,
                    'name' => $language->name,
                ],
                'number_of_pages' => $data['number_of_pages'],
                'number_of_copies' => $data['number_of_copies'],
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->putJson('api/editions/999', []);

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_book_id()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['book_id' => null]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('book_id');
    }

    /** @test */
    public function book_id_must_exist()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['book_id' => 999]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('book_id');
    }

    /** @test */
    public function it_requires_an_isbn()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['isbn' => null]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('isbn');
    }

    /** @test */
    public function it_requires_a_release_year()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['release_year' => null]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_numeric()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['release_year' => 'not-a-valid-number']);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_positive()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['release_year' => -1]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function it_requires_a_language_id()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['language_id' => null]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('language_id');
    }

    /** @test */
    public function language_id_must_exist()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['language_id' => 999]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('language_id');
    }

    /** @test */
    public function it_requires_a_number_of_pages()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['number_of_pages' => null]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('number_of_pages');
    }

    /** @test */
    public function number_of_pages_must_be_numeric()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['number_of_pages' => 'not-a-valid-number']);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('number_of_pages');
    }

    /** @test */
    public function number_of_pages_must_be_positive()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['number_of_pages' => -1]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('number_of_pages');
    }

    /** @test */
    public function it_requires_a_number_of_copies()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['number_of_copies' => null]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('number_of_copies');
    }

    /** @test */
    public function number_of_copies_must_be_numeric()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['number_of_copies' => 'not-a-valid-number']);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('number_of_copies');
    }

    /** @test */
    public function number_of_copies_must_be_positive()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['number_of_copies' => -1]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('number_of_copies');
    }
}