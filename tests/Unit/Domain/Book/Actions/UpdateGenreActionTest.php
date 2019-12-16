<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\UpdateGenreAction;
use App\Domain\Book\DataTransferObjects\GenreData;
use App\Domain\Book\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateGenreActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_genre()
    {
        $genre = factory(Genre::class)->create();
        $genreData = new GenreData([
            'name' => 'Romány',
        ]);

        $genre = (new UpdateGenreAction())->execute($genre, $genreData);

        $this->assertEquals($genreData->name, $genre->name);
    }
}
