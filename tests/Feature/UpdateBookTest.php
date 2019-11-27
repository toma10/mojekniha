<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateBookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_book()
    {
        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        $data = [
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
        ];

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertOk();
        $response->assertJson([
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
    public function cover_image_path_is_returned_if_included()
    {
        Storage::fake('public');

        $book = factory(Book::class)->create();
        $file = File::image('cover-image.jpg', $width = 400);
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJson([
            'data' => [
                'cover_image_path' => $book->getFirstMediaUrl('cover-image'),
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->putJson('api/books/999', []);

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['name' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function it_requires_an_original_name()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['original_name' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('original_name');
    }

    /** @test */
    public function it_requires_a_description()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['description' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('description');
    }

    /** @test */
    public function it_requires_a_release_year()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['release_year' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_numeric()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['release_year' => 'not-a-valid-number']);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_positive()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['release_year' => -1]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('release_year');
    }

    /** @test */
    public function it_requires_an_author_id()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['author_id' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('author_id');
    }

    /** @test */
    public function author_id_must_exist()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['author_id' => 999]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('author_id');
    }

    /** @test */
    public function cover_image_must_be_an_image()
    {
        Storage::fake('public');

        $book = factory(Book::class)->create();
        $file = File::create('not-a-valid-image.pdf');
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_a_jpg()
    {
        Storage::fake('public');

        $book = factory(Book::class)->create();
        $file = File::image('not-a-jpg-image.png', $width = 400);
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_at_least_400px_wide()
    {
        Storage::fake('public');

        $book = factory(Book::class)->create();
        $file = File::image('cover-image.jpg', $width = 399);
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonValidationErrors('cover_image');
    }

    /** @test */
    public function cover_image_is_optional()
    {
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['cover_image' => null]);

        $response = $this->putJson("api/books/{$book->id}", $data);

        $response->assertJsonMissingValidationErrors('cover_image');
    }
}
