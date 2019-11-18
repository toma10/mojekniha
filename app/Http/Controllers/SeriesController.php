<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Response;
use App\Actions\CreateSeriesAction;
use App\Actions\DeleteSeriesAction;
use App\Actions\UpdateSeriesAction;
use App\Http\Requests\SeriesRequest;
use App\Http\Resources\SeriesResource;
use App\DataTransferObjects\SeriesData;

class SeriesController
{
    public function show(Series $series)
    {
        return new SeriesResource($series);
    }

    public function store(SeriesRequest $request, CreateSeriesAction $createSeriesAction)
    {
        $series = $createSeriesAction->execute(
            new SeriesData($request->validated())
        );

        return (new SeriesResource($series))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Series $series, SeriesRequest $request, UpdateSeriesAction $updateSeriesAction)
    {
        $series = $updateSeriesAction->execute(
            $series,
            new SeriesData($request->validated())
        );

        return new SeriesResource($series);
    }

    public function destroy(Series $series, DeleteSeriesAction $deleteSeriesAction)
    {
        $deleteSeriesAction->execute($series);

        return response()->json();
    }
}
