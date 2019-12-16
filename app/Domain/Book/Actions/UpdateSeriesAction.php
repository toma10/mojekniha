<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\SeriesData;
use App\Domain\Book\Models\Series;

class UpdateSeriesAction
{
    public function execute(Series $series, SeriesData $seriesData): Series
    {
        return tap($series)->update($seriesData->all());
    }
}
