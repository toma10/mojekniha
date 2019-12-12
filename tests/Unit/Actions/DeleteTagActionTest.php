<?php

namespace Tests\Unit\Actions;

use App\Actions\DeleteTagAction;
use App\Models\Tag;
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
