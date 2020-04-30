<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\BookBinding;
use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Language;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\InertiaTestCase;

class CreateEditionTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/editions/create')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/editions/create')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_create_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Book::class, 3)->create();
        factory(Language::class, 4)->create();
        factory(BookBinding::class, 2)->create();

        $this->actingAs($admin, 'web')->get('admin/books/editions/create')
            ->assertOk()
            ->assertPropCount('books', 3)
            ->assertPropCount('languages', 4)
            ->assertPropCount('bookBindings', 2);
    }

    /** @test */
    public function it_creates_the_edition()
    {
        $admin = factory(User::class)->states('admin')->create();
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

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response
            ->assertRedirect('admin/books/editions')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function book_id_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['book_id' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('book_id');
    }

    /** @test */
    public function book_id_must_exist()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['book_id' => 999]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('book_id');
    }

    /** @test */
    public function isbn_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['isbn' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('isbn');
    }

    /** @test */
    public function release_year_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['release_year' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_integer()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['release_year' => 2015.5]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('release_year');
    }

    /** @test */
    public function release_year_must_be_positive()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['release_year' => -1]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('release_year');
    }

    /** @test */
    public function language_id_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['language_id' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('language_id');
    }

    /** @test */
    public function language_id_must_exist()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['language_id' => 999]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('language_id');
    }

    /** @test */
    public function number_of_pages_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['number_of_pages' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('number_of_pages');
    }

    /** @test */
    public function number_of_pages_must_be_integer()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['number_of_pages' => 2015.5]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('number_of_pages');
    }

    /** @test */
    public function number_of_pages_must_be_positive()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['number_of_pages' => -1]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('number_of_pages');
    }

    /** @test */
    public function number_of_copies_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['number_of_copies' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('number_of_copies');
    }

    /** @test */
    public function number_of_copies_must_be_integer()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['number_of_copies' => 2015.5]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('number_of_copies');
    }

    /** @test */
    public function number_of_copies_must_be_positive()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['number_of_copies' => -1]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('number_of_copies');
    }

    /** @test */
    public function book_binding_id_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['book_binding_id' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('book_binding_id');
    }

    /** @test */
    public function book_binding_id_must_exist()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['book_binding_id' => 999]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('book_binding_id');
    }

    /** @test */
    public function cover_image_must_be_an_image()
    {
        Storage::fake('public');

        $admin = factory(User::class)->states('admin')->create();
        $file = File::create('not-a-valid-image.pdf');
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_a_jpg()
    {
        Storage::fake('public');

        $admin = factory(User::class)->states('admin')->create();
        $file = File::image('not-a-jpg-image.png', $width = 400);
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('cover_image');
    }

    /** @test */
    public function cover_image_must_be_at_least_400px_wide()
    {
        Storage::fake('public');

        $admin = factory(User::class)->states('admin')->create();
        $file = File::image('cover-image.jpg', $width = 399);
        $data = factory(Edition::class)->raw(['cover_image' => $file]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionHasErrors('cover_image');
    }

    /** @test */
    public function cover_image_is_optional()
    {
        Storage::fake('public');

        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Edition::class)->raw(['cover_image' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/editions', $data);

        $response->assertSessionDoesntHaveErrors('cover_image');
    }
}
