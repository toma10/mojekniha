<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\CreateGenreAction;
use App\Domain\Book\DataTransferObjects\GenreData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
