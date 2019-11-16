<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Genre;
use App\Actions\UpdateGenreAction;
use App\DataTransferObjects\GenreData;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
