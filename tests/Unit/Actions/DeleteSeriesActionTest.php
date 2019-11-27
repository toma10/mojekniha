<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Series;
use App\Actions\DeleteSeriesAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
