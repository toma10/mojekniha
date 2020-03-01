<?php

namespace Tests\Unit\Domain\Book\Models;

use App\Domain\Book\Models\Edition;
use App\Domain\Book\Models\Language;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_may_have_multiple_editions()
    {
        $language = factory(Language::class)->create();
        $editionA = factory(Edition::class)->create(['language_id' => $language]);
        $editionB = factory(Edition::class)->create(['language_id' => $language]);

        $this->assertInstanceOf(HasMany::class, $language->editions());
        $language->editions->assertContains($editionA, $editionB);
    }
}
