<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Actions\CreateGenreAction;
use App\DataTransferObjects\GenreData;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateGenreActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_genre()
    {
        $genreData = new GenreData([
            'name' => 'Romány',
        ]);

        $genre = (new CreateGenreAction())->execute($genreData);

        $this->assertEquals($genreData->name, $genre->name);
    }
}
