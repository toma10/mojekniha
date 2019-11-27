<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Genre;
use App\Actions\DeleteGenreAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteGenreActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_genre()
    {
        $genre = factory(Genre::class)->create();

        (new DeleteGenreAction())->execute($genre);

        $this->assertDeleted($genre);
    }
}
