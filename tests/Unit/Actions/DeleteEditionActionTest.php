<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Edition;
use App\Actions\DeleteEditionAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteEditionActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_edition()
    {
        $edition = factory(Edition::class)->create();

        (new DeleteEditionAction())->execute($edition);

        $this->assertNull($edition->fresh());
    }
}
