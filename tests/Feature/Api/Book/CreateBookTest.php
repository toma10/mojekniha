<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_book()
    {
        $author = factory(Author::class)->create();
        $data = [
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
        ];

        $response = $this->postJson('api/books', $data);

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
    public function cover_image_path_is_returned_if_cover_image_is_included()
    {
        Storage::fake('public');

        $file = File::image('cover-image.jpg', $width = 400);
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->postJson('api/books', $data);

        $this->assertNotNull($book = Book::first());
        $response->assertJson([
            'data' => [
                'cover_image_path' => $book->getFirstMediaUrl('cover-image'),
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $data = factory(Book::class)->raw(['name' => null]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_an_original_name()
    {
        $data = factory(Book::class)->raw(['original_name' => null]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('original_name');
    }

    /** @test */
    public function it_requires_a_description()
    {
        $data = factory(Book::class)->raw(['description' => null]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('description');
    }

    /** @test */
    public function it_requires_a_release_year()
    {
        $data = factory(Book::class)->raw(['release_year' => null]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_numeric()
    {
        $data = factory(Book::class)->raw(['release_year' => 'not-a-valid-number']);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_positive()
    {
        $data = factory(Book::class)->raw(['release_year' => -1]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function it_requires_an_author_id()
    {
        $data = factory(Book::class)->raw(['author_id' => null]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('author_id');
    }

    /** @test */
    public function author_id_must_exist()
    {
        $data = factory(Book::class)->raw(['author_id' => 999]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('author_id');
    }

    /** @test */
    public function cover_image_must_be_an_image()
    {
        Storage::fake('public');

        $file = File::create('not-a-valid-image.pdf');
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_a_jpg()
    {
        Storage::fake('public');

        $file = File::image('not-a-jpg-image.png', $width = 400);
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_at_least_400px_wide()
    {
        Storage::fake('public');

        $file = File::image('cover-image.jpg', $width = 399);
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_is_optional()
    {
        $data = factory(Book::class)->raw(['cover_image' => null]);

        $response = $this->postJson('api/books', $data);

        $response->assertJsonMissingValidationErrors('cover_image');
    }
}
