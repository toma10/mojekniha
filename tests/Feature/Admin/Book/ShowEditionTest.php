<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Edition;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowEditionTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $edition = factory(Edition::class)->create();

        $this->get("admin/books/editions/{$edition->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/editions/{$edition->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $edition = factory(Edition::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/editions/{$edition->id}");

        $response
            ->assertOk()
            ->assertHasProp('edition')
            ->assertPropValue('edition', function ($givenEdition) use ($edition) {
                $this->assertEquals($edition->id, $givenEdition['id']);
            });
    }
}
