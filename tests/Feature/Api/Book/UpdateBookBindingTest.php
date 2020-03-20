<?php

namespace Tests\Feature\Api\Book;

use App\Domain\Book\Models\BookBinding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateBookBindingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_book_binding()
    {
        $bookBinding = factory(BookBinding::class)->create();
        $data = [
            'name' => 'pevná / vázaná s přebalem',
        ];

        $response = $this->putJson("api/book-bindings/{$bookBinding->id}", $data);

        $response->assertOk();
        $response->assertExactJson([
            'data' => [
                'id' => $bookBinding['id'],
                'name' => $data['name'],
            ],
        ]);
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->putJson('api/book-bindings/999', []);

        $response->assertNotFound();
    }

    /** @test */
    public function it_requires_a_name()
    {
        $bookBinding = factory(BookBinding::class)->create();
        $data = factory(BookBinding::class)->raw(['name' => null]);

        $response = $this->putJson("api/book-bindings/{$bookBinding->id}", $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $bookBinding = factory(BookBinding::class)->create(['name' => 'pevná / vázaná s přebalem']);
        $data = factory(BookBinding::class)->raw(['name' => 'pevná / vázaná s přebalem']);

        $response = $this->putJson("api/book-bindings/{$bookBinding->id}", $data);

        $response->assertJsonValidationErrors('name');
    }
}
