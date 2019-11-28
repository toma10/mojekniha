<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\BookBinding;
use App\Actions\DeleteBookBindingAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
