<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Language;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowLanguageTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $language = factory(Language::class)->create();

        $this->get("admin/books/languages/{$language->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/languages/{$language->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $language = factory(Language::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/languages/{$language->id}");

        $response
            ->assertOk()
            ->assertHasProp('language')
            ->assertPropValue('language', function ($givenLanguage) use ($language) {
                $this->assertEquals($language->id, $givenLanguage['id']);
            });
    }
}
