<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Author;
use App\Actions\DeleteAuthorAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteAuthorActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_author()
    {
        $author = factory(Author::class)->create();

        (new DeleteAuthorAction())->execute($author);

        $this->assertSoftDeleted($author);
    }
}
