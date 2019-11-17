<?php

namespace Tests\Unit\Actions;

use App\Models\Tag;
use Tests\TestCase;
use App\Actions\DeleteTagAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTagActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_tag()
    {
        $tag = factory(Tag::class)->create();

        (new DeleteTagAction())->execute($tag);

        $this->assertNull($tag->fresh());
    }
}
