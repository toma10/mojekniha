<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\Book;
use App\Actions\DeleteBookAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteBookActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_book()
    {
        $book = factory(Book::class)->create();

        (new DeleteBookAction())->execute($book);

        $this->assertNull($book->fresh());
    }
}
