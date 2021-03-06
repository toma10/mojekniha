<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\CreateSeriesAction;
use App\Domain\Book\DataTransferObjects\SeriesData;
use App\Domain\Book\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateSeriesActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_series()
    {
        $author = factory(Author::class)->create();
        $seriesData = new SeriesData([
            'name' => 'Hlava XXII',
            'author_id' => $author->id,
        ]);

        $genre = (new CreateSeriesAction())->execute($seriesData);

        $this->assertEquals($seriesData->name, $genre->name);
        $this->assertEquals($seriesData->author_id, $genre->author_id);
    }
}
