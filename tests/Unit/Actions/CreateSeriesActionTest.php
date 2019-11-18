<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Author;
use App\Actions\CreateSeriesAction;
use App\DataTransferObjects\SeriesData;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
