<?php

namespace Tests\Unit\Domain\Book\Models;

use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Nationality;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NationalityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_may_have_multiple_authors()
    {
        $nationality = factory(Nationality::class)->create();
        $authorA = factory(Author::class)->create(['nationality_id' => $nationality]);
        $authorB = factory(Author::class)->create(['nationality_id' => $nationality]);

        $this->assertInstanceOf(HasMany::class, $nationality->authors());
        $nationality->authors->assertContains($authorA, $authorB);
    }
}
