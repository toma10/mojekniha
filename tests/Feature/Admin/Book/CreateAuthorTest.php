<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Nationality;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\InertiaTestCase;

class CreateAuthorTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/authors/create')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/authors/create')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_create_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Nationality::class, 3)->create();

        $this->actingAs($admin, 'web')->get('admin/books/authors/create')
            ->assertOk()
            ->assertPropCount('nationalities', 3);
    }

    /** @test */
    public function it_creates_an_author()
    {
        $admin = factory(User::class)->states('admin')->create();
        $nationality = factory(Nationality::class)->create(['name' => 'americká']);
        $data = [
            'name' => 'Joseph Heller',
            'birth_date' => '1923-05-01',
            'death_date' => '1999-12-12',
            'biography' => 'Psal satirická díla, zejména novely a dramata.',
            'nationality_id' => $nationality->id,
        ];

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response
            ->assertRedirect('admin/books/authors')
            ->assertSessionHasFlashMessage('success');
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['name' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function birth_date_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['birth_date' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('birth_date');
    }

    /** @test */
    public function birth_date_must_be_valid_date()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['birth_date' => 'not-a-valid-date']);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('birth_date');
    }

    /** @test */
    public function death_date_is_optional()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['death_date' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionDoesntHaveErrors('death_date');
    }

    /** @test */
    public function death_date_must_be_valid_date()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['death_date' => 'not-a-valid-date']);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('death_date');
    }

    /** @test */
    public function biography_is_optional()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['biography' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionDoesntHaveErrors('biography');
    }

    /** @test */
    public function biography_must_be_string()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['biography' => 123]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('biography');
    }

    /** @test */
    public function nationality_id_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['nationality_id' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('nationality_id');
    }

    /** @test */
    public function nationality_id_must_exist()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['nationality_id' => 999]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('nationality_id');
    }

    /** @test */
    public function portrait_image_must_be_an_image()
    {
        Storage::fake('public');

        $admin = factory(User::class)->states('admin')->create();
        $file = File::create('not-a-valid-image.pdf');
        $data = factory(Author::class)->raw(['portrait_image' => $file]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('portrait_image');
    }

    /** @test */
    public function portrait_image_must_be_a_jpg()
    {
        Storage::fake('public');

        $admin = factory(User::class)->states('admin')->create();
        $file = File::image('not-a-jpg-image.png', $width = 400);
        $data = factory(Author::class)->raw(['portrait_image' => $file]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('portrait_image');
    }

    /** @test */
    public function portrait_image_must_be_at_least_400px_wide()
    {
        Storage::fake('public');

        $admin = factory(User::class)->states('admin')->create();
        $file = File::image('portrait-image.jpg', $width = 399);
        $data = factory(Author::class)->raw(['portrait_image' => $file]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionHasErrors('portrait_image');
    }

    /** @test */
    public function portrait_image_is_optional()
    {
        $admin = factory(User::class)->states('admin')->create();
        $data = factory(Author::class)->raw(['portrait_image' => null]);

        $response = $this->actingAs($admin, 'web')->post('admin/books/authors', $data);

        $response->assertSessionDoesntHaveErrors('portrait_image');
    }
}
