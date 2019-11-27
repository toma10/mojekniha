<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Language;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateEditionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_edition()
    {
        $book = factory(Book::class)->create();
        $language = factory(Language::class)->create(['name' => 'český']);
        $data = [
            'book_id' => $book->id,
            'isbn' => '978-80-7381-931-6',
            'release_year' => 2011,
            'language_id' => $language->id,
            'number_of_pages' => 536,
            'number_of_copies' => 1000,
        ];

        $response = $this->postJson('api/editions', $data);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ['id']]);
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
    public function cover_image_path_is_returned_if_cover_image_is_included()
    {
        Storage::fake('public');

        $file = File::image('cover-image.jpg', $width = 400);
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->postJson('api/editions', $data);

        $this->assertNotNull($edition = Edition::first());
        $response->assertJson([
            'data' => [
                'cover_image_path' => $edition->getFirstMediaUrl('cover-image'),
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_book_id()
    {
        $data = factory(Edition::class)->raw(['book_id' => null]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('book_id');
    }

    /** @test */
    public function book_id_must_exist()
    {
        $data = factory(Edition::class)->raw(['book_id' => 999]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('book_id');
    }

    /** @test */
    public function it_requires_an_isbn()
    {
        $data = factory(Edition::class)->raw(['isbn' => null]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('isbn');
    }

    /** @test */
    public function it_requires_a_release_year()
    {
        $data = factory(Edition::class)->raw(['release_year' => null]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_numeric()
    {
        $data = factory(Edition::class)->raw(['release_year' => 'not-a-valid-number']);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_positive()
    {
        $data = factory(Edition::class)->raw(['release_year' => -1]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function it_requires_a_language_id()
    {
        $data = factory(Edition::class)->raw(['language_id' => null]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('language_id');
    }

    /** @test */
    public function language_id_must_exist()
    {
        $data = factory(Edition::class)->raw(['language_id' => 999]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('language_id');
    }

    /** @test */
    public function it_requires_a_number_of_pages()
    {
        $data = factory(Edition::class)->raw(['number_of_pages' => null]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('number_of_pages');
    }

    /** @test */
    public function number_of_pages_must_be_numeric()
    {
        $data = factory(Edition::class)->raw(['number_of_pages' => 'not-a-valid-number']);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('number_of_pages');
    }

    /** @test */
    public function number_of_pages_must_be_positive()
    {
        $data = factory(Edition::class)->raw(['number_of_pages' => -1]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('number_of_pages');
    }

    /** @test */
    public function it_requires_a_number_of_copies()
    {
        $data = factory(Edition::class)->raw(['number_of_copies' => null]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('number_of_copies');
    }

    /** @test */
    public function number_of_copies_must_be_numeric()
    {
        $data = factory(Edition::class)->raw(['number_of_copies' => 'not-a-valid-number']);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('number_of_copies');
    }

    /** @test */
    public function number_of_copies_must_be_positive()
    {
        $data = factory(Edition::class)->raw(['number_of_copies' => -1]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('number_of_copies');
    }

    /** @test */
    public function cover_image_must_be_an_image()
    {
        Storage::fake('public');

        $file = File::create('not-a-valid-image.pdf');
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_a_jpg()
    {
        Storage::fake('public');

        $file = File::image('not-a-jpg-image.png', $width = 400);
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_at_least_400px_wide()
    {
        Storage::fake('public');

        $file = File::image('cover-image.jpg', $width = 399);
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_is_optional()
    {
        $data = factory(Edition::class)->raw(['cover_image' => null]);

        $response = $this->postJson('api/editions', $data);

        $response->assertJsonMissingValidationErrors('cover_image');
    }
}
