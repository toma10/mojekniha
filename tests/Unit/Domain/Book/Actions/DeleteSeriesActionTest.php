<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\DeleteSeriesAction;
use App\Domain\Book\Models\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteSeriesActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_series()
    {
        $series = factory(Series::class)->create();

        (new DeleteSeriesAction())->execute($series);

        $this->assertDeleted($series);
    }
}
