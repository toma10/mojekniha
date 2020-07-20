<?php

namespace Tests\Unit\Domain\Shared\Support;

use App\Domain\Shared\Support\HtmlFormatter;
use Tests\TestCase;

class HtmlFormatterTest extends TestCase
{
    /** @test */
    public function it_formats_string()
    {
        $biography = 'Celým jménem Antoine-Jean-Babtiste-Marie-Roger de Saint-Exupéry, narodil se v Lyonu a tragicky zahynul v létě 1944, patrně sestřelen německým letadlem v prostoru Korsiky nebo nad Alpami.

Jeho život i tvorba jsou mimořádně sourodé, obojí určuje Saint-Exupéryho povolání letce, ale i psychické založení hluboce citlivého a ušlechtilého člověka.

Po studiu na Námořní škole, které ho nijak nenadchlo, sloužil jako voják u letectva, kde propukla jeho vášeň pro létání. Jako pilot byl zaměstnán u vícero leteckých společností a létal na různých linkách.';

        $expectedResult = '<p>Celým jménem Antoine-Jean-Babtiste-Marie-Roger de Saint-Exupéry, narodil se v Lyonu a tragicky zahynul v létě 1944, patrně sestřelen německým letadlem v prostoru Korsiky nebo nad Alpami.</p><p>Jeho život i tvorba jsou mimořádně sourodé, obojí určuje Saint-Exupéryho povolání letce, ale i psychické založení hluboce citlivého a ušlechtilého člověka.</p><p>Po studiu na Námořní škole, které ho nijak nenadchlo, sloužil jako voják u letectva, kde propukla jeho vášeň pro létání. Jako pilot byl zaměstnán u vícero leteckých společností a létal na různých linkách.</p>';

        $this->assertEquals($expectedResult, HtmlFormatter::format($biography));
    }
}
