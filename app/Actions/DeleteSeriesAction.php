<?php

namespace App\Actions;

use App\Models\Series;

class DeleteSeriesAction
{
    public function execute(Series $series): void
    {
        $series->delete();
    }
}
