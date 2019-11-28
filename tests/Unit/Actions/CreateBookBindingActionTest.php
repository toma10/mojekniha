<?php

namespace Tests\Unit\Actions;

use Tests\TestCase;
use App\Actions\CreateBookBindingAction;
use App\DataTransferObjects\BookBindingData;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
