<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\DeleteGenreAction;
use App\Domain\Book\Models\Genre;
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
