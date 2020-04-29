<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\Series;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Tests\InertiaTestCase;

class UpdateBookTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create();

        $this->get("admin/books/books/{$book->id}/edit")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/books/{$book->id}/edit")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_edit_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/books/{$book->id}/edit");

        $response
            ->assertOk()
            ->assertHasProp('book')
            ->assertPropValue('book', function ($givenBook) use ($book) {
                $this->assertEquals($book->id, $givenBook['id']);
            });
    }

    /** @test */
    public function it_updates_the_tag()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        $series = factory(Series::class)->create();
        $data = [
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Hlavní postavou je poručík letectva Yossarian, který je trochu klaun a trochu blázen.',
            'release_year' => 1961,
            'author_id' => $author->id,
            'series_id' => $series->id,
        ];

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response
            ->assertRedirect("admin/books/books/{$book->id}/edit")
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function original_name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['original_name' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('original_name');
    }

    /** @test */
    public function description_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['description' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function release_year_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['release_year' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_integer()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['release_year' => 2000.5]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_positive()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['release_year' => -1]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('release_year');
    }

    /** @test */
    public function author_id_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['author_id' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function author_id_must_exist()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['author_id' => 999]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function series_id_must_exist()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['series_id' => 999]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('series_id');
    }

    /** @test */
    public function series_id_is_optional()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['series_id' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionDoesntHaveErrors('series_id');
    }

    /** @test */
    public function cover_image_must_be_an_image()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $file = File::create('not-a-valid-image.pdf');
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_a_jpg()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $file = File::image('not-a-jpg-image.png', $width = 400);
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_at_least_400px_wide()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $file = File::image('cover-image.jpg', $width = 399);
        $data = factory(Book::class)->raw(['cover_image' => $file]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionHasErrors('cover_image');
    }

    /** @test */
    public function cover_image_is_optional()
    {
        $admin = factory(User::class)->states('admin')->create();
        $book = factory(Book::class)->create();
        $data = factory(Book::class)->raw(['cover_image' => null]);

        $response = $this->actingAs($admin, 'web')->put("admin/books/books/{$book->id}", $data);

        $response->assertSessionDoesntHaveErrors('cover_image');
    }
}
