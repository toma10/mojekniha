<?php

namespace App\Actions;

use App\DataTransferObjects\SeriesData;
use App\Models\Series;

class UpdateSeriesAction
{
    public function execute(Series $series, SeriesData $seriesData): Series
    {
        return tap($series)->update($seriesData->all());
    }
}
