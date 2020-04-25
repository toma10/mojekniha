<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Nationality;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListNationalitiesTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/nationalities')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/nationalities')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Nationality::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/nationalities');

        $response
            ->assertOk()
            ->assertPropCount('nationalities.data', 3)
            ->assertPropCount('nationalities.links.pages', 1);
    }
}
