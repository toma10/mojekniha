<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\DeleteTagAction;
use App\Domain\Book\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTagActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_tag()
    {
        $tag = factory(Tag::class)->create();

        (new DeleteTagAction())->execute($tag);

        $this->assertDeleted($tag);
    }
}
