<?php

namespace App\Actions;

use App\Models\Series;
use App\DataTransferObjects\SeriesData;

class CreateSeriesAction
{
    public function execute(SeriesData $seriesData): Series
    {
        return Series::create($seriesData->all());
    }
}
