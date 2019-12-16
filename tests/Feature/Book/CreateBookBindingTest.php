<?php

namespace Tests\Feature\Book;

use App\Domain\Book\Models\BookBinding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateBookBindingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_book_binding()
    {
        $data = [
            'name' => 'pevná / vázaná s přebalem',
        ];

        $response = $this->postJson('api/book-bindings', $data);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ['id']]);
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
            ],
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $data = factory(BookBinding::class)->raw(['name' => null]);

        $response = $this->postJson('api/book-bindings', $data);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        factory(BookBinding::class)->create(['name' => 'pevná / vázaná s přebalem']);
        $data = factory(BookBinding::class)->raw(['name' => 'pevná / vázaná s přebalem']);

        $response = $this->postJson('api/book-bindings', $data);

        $response->assertJsonValidationErrors('name');
    }
}
