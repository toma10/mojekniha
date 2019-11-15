<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Nationality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
