<?php

namespace App\Actions;

use App\DataTransferObjects\SeriesData;
use App\Models\Series;

class CreateSeriesAction
{
    public function execute(SeriesData $seriesData): Series
    {
        return Series::create($seriesData->all());
    }
}
