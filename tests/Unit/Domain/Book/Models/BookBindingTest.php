<?php

namespace Tests\Unit\Domain\Book\Models;

use App\Domain\Book\Models\BookBinding;
use App\Domain\Book\Models\Edition;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookBindingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_may_have_multiple_editions()
    {
        $bookBinding = factory(BookBinding::class)->create();
        $editionA = factory(Edition::class)->create();
        $editionB = factory(Edition::class)->create();

        $bookBinding->editions()->saveMany([$editionA, $editionB]);

        $this->assertInstanceOf(HasMany::class, $bookBinding->editions());
        $bookBinding->editions->assertContains($editionA, $editionB);
    }
}
