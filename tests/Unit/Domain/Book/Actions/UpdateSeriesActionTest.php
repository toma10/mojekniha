<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\UpdateSeriesAction;
use App\Domain\Book\DataTransferObjects\SeriesData;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateSeriesActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_series()
    {
        $series = factory(Series::class)->create();
        $author = factory(Author::class)->create();
        $seriesData = new SeriesData([
            'name' => 'Hlava XXII',
            'author_id' => $author->id,
        ]);

        $series = (new UpdateSeriesAction())->execute($series, $seriesData);

        $this->assertEquals($seriesData->name, $series->name);
        $this->assertEquals($seriesData->author_id, $series->author_id);
    }
}
