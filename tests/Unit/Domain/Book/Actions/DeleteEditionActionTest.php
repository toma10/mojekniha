<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\DeleteEditionAction;
use App\Domain\Book\Models\Edition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteEditionActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_edition()
    {
        $edition = factory(Edition::class)->create();

        (new DeleteEditionAction())->execute($edition);

        $this->assertDeleted($edition);
    }
}
