<?php

namespace Tests\Unit\Actions;

use App\Actions\DeleteGenreAction;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
