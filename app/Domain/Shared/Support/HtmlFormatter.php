<?php

namespace App\Domain\Shared\Support;

class HtmlFormatter
{
    public static function format(string $string): string
    {
        $plaintString = strip_tags(trim($string));

        return collect(explode("\n", $plaintString))
            ->filter()
            ->map(fn ($line) => sprintf('<p>%s</p>', $line))
            ->join('');
    }
}
