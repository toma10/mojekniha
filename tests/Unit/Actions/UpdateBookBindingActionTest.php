<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Models\BookBinding;
use App\Actions\UpdateBookBindingAction;
use App\DataTransferObjects\BookBindingData;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
