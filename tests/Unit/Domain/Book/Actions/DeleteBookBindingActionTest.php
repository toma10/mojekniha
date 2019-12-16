<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\DeleteBookBindingAction;
use App\Domain\Book\Models\BookBinding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteBookBindingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_book_binding()
    {
        $bookBinding = factory(BookBinding::class)->create();

        (new DeleteBookBindingAction())->execute($bookBinding);

        $this->assertDeleted($bookBinding);
    }
}
