<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\Models\Series;

class DeleteSeriesAction
{
    public function execute(Series $series): void
    {
        $series->delete();
    }
}
