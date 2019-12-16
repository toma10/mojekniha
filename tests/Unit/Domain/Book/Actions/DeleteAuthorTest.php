<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\DeleteAuthorAction;
use App\Domain\Book\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
