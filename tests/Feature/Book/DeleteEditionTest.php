<?php

namespace Tests\Feature\Book;

use App\Domain\Book\Models\Edition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteEditionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_edition()
    {
        $edition = factory(Edition::class)->create();

        $response = $this->deleteJson("api/editions/{$edition->id}");

        $response->assertOk();
    }

    /** @test */
    public function it_404s_if_invalid_id_is_provided()
    {
        $response = $this->deleteJson('api/editions/999');

        $response->assertNotFound();
    }
}
