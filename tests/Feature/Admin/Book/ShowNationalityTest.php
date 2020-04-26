<?php

namespace Tests\Feature\Admin\Book;

use App\Domain\Book\Models\Nationality;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class ShowNationalityTest extends InertiaTestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_admin()
    {
        $user = factory(User::class)->create();
        $nationality = factory(Nationality::class)->create();

        $this->get("admin/books/nationalities/{$nationality->id}")
            ->assertRedirect();

        $this->actingAs($user, 'web')->get("admin/books/nationalities/{$nationality->id}")
            ->assertRedirect();
    }

    /** @test */
    public function viewing_show_page()
    {
        $admin = factory(User::class)->states('admin')->create();
        $nationality = factory(Nationality::class)->create();

        $response = $this->actingAs($admin, 'web')->get("admin/books/nationalities/{$nationality->id}");

        $response
            ->assertOk()
            ->assertHasProp('nationality')
            ->assertPropValue('nationality', function ($givenNationality) use ($nationality) {
                $this->assertEquals($nationality->id, $givenNationality['id']);
            });
    }
}
