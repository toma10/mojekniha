<?php

namespace App\Actions;

use App\Models\Series;
use App\DataTransferObjects\SeriesData;

class UpdateSeriesAction
{
    public function execute(Series $series, SeriesData $seriesData): Series
    {
        return tap($series)->update($seriesData->all());
    }
}
