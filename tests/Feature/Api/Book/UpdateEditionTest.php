<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\BookBinding;
use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateEditionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_edition()
    {
        $edition = factory(Edition::class)->create();
        $book = factory(Book::class)->create();
        $language = factory(Language::class)->create(['name' => 'český']);
        $bookBinding = factory(BookBinding::class)->create(['name' => 'pevná / vázaná s přebalem']);
        $data = [
            'book_id' => $book->id,
            'isbn' => '978-80-7381-931-6',
            'release_year' => 2011,
            'language_id' => $language->id,
            'number_of_pages' => 536,
            'number_of_copies' => 1000,
            'book_binding_id' => $bookBinding->id,
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
                'book_binding' => [
                    'id' => $bookBinding->id,
                    'name' => $bookBinding->name,
                ],
                'cover_url' => url(Edition::FALLBACK_COVER_IMAGE),
            ],
        ]);
    }

    /** @test */
    public function cover_url_is_returned_if_cover_image_is_included()
    {
        Storage::fake('public');

        $edition = factory(Edition::class)->create();
        $file = File::image('cover-image.jpg', $width = 400);
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJson([
            'data' => [
                'cover_url' => $edition->getFirstMediaUrl('cover-image'),
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
    public function release_year_must_be_integer()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['release_year' => 2015.5]);

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
    public function number_of_pages_must_be_integer()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['number_of_pages' => 150.5]);

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
    public function number_of_copies_must_be_integer()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['number_of_copies' => 150000.5]);

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

    /** @test */
    public function it_requires_a_book_binding_id()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['book_binding_id' => null]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('book_binding_id');
    }

    /** @test */
    public function book_binding_id_must_exist()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['book_binding_id' => 999]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('book_binding_id');
    }

    /** @test */
    public function cover_image_must_be_an_image()
    {
        Storage::fake('public');

        $edition = factory(Edition::class)->create();
        $file = File::create('not-a-valid-image.pdf');
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_a_jpg()
    {
        Storage::fake('public');

        $edition = factory(Edition::class)->create();
        $file = File::image('not-a-jpg-image.png', $width = 400);
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_at_least_400px_wide()
    {
        Storage::fake('public');

        $edition = factory(Edition::class)->create();
        $file = File::image('cover-image.jpg', $width = 399);
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_is_optional()
    {
        $edition = factory(Edition::class)->create();
        $data = factory(Edition::class)->raw(['cover_image' => null]);

        $response = $this->putJson("api/editions/{$edition->id}", $data);

        $response->assertJsonMissingValidationErrors('cover_image');
    }
}
