<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Language;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ListLanguagesTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();

        $this->get('admin/books/languages')
            ->assertRedirect();

        $this->actingAs($user, 'web')->get('admin/books/languages')
            ->assertRedirect();
    }

    /** @test */
    public function viewing_index_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Language::class, 3)->create();

        $response = $this->actingAs($admin, 'web')->get('admin/books/languages');

        $response
            ->assertOk()
            ->assertPropCount('languages.data', 3)
            ->assertPropCount('languages.links.pages', 1);
    }
}
