<?php

namespace Tests\Unit\Actions;

use App\Actions\DeleteBookAction;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteBookActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_book()
    {
        $book = factory(Book::class)->create();

        (new DeleteBookAction())->execute($book);

        $this->assertSoftDeleted($book);
    }
}
