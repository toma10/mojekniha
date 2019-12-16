<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\UpdateBookBindingAction;
use App\Domain\Book\DataTransferObjects\BookBindingData;
use App\Domain\Book\Models\BookBinding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateBookBindingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_the_book_binding()
    {
        $bookBinding = factory(BookBinding::class)->create();
        $bookBindingData = new BookBindingData([
            'name' => 'pevná / vázaná s přebalem',
        ]);

        $bookBinding = (new UpdateBookBindingAction())->execute($bookBinding, $bookBindingData);

        $this->assertEquals($bookBindingData->name, $bookBinding->name);
    }
}
