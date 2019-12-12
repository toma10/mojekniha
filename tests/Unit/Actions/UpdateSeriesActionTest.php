<?php

namespace Tests\Unit\Actions;

use App\Actions\UpdateSeriesAction;
use App\DataTransferObjects\SeriesData;
use App\Models\Author;
use App\Models\Series;
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
