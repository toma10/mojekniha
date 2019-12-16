<?php

namespace App\Domain\Book\Actions;

use App\Domain\Book\DataTransferObjects\SeriesData;
use App\Domain\Book\Models\Series;

class CreateSeriesAction
{
    public function execute(SeriesData $seriesData): Series
    {
        return Series::create($seriesData->all());
    }
}
