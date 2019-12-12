<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateGenreAction;
use App\DataTransferObjects\GenreData;
use App\Models\Genre;
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
