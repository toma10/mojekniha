<?php

namespace Tests\Unit\Domain\Book\Actions;

use App\Domain\Book\Actions\CreateBookBindingAction;
use App\Domain\Book\DataTransferObjects\BookBindingData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateBookBindingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_book()
    {
        $bookBindingData = new BookBindingData([
            'name' => 'pevná / vázaná s přebalem',
        ]);

        $bookBinding = app(CreateBookBindingAction::class)->execute($bookBindingData);

        $this->assertEquals($bookBindingData->name, $bookBinding->name);
    }
}
