<?php

namespace App\Http\Controllers;

use App\Actions\CreateSeriesAction;
use App\Actions\DeleteSeriesAction;
use App\Actions\UpdateSeriesAction;
use App\DataTransferObjects\SeriesData;
use App\Http\Requests\SeriesRequest;
use App\Http\Resources\SeriesResource;
use App\Models\Series;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class SeriesController
{
    public function show(Series $series): JsonResource
    {
        return new SeriesResource($series);
    }

    public function store(SeriesRequest $request, CreateSeriesAction $createSeriesAction): JsonResponse
    {
        $series = $createSeriesAction->execute(
            new SeriesData($request->validated())
        );

        return (new SeriesResource($series))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Series $series, SeriesRequest $request, UpdateSeriesAction $updateSeriesAction): JsonResource
    {
        $series = $updateSeriesAction->execute(
            $series,
            new SeriesData($request->validated())
        );

        return new SeriesResource($series);
    }

    public function destroy(Series $series, DeleteSeriesAction $deleteSeriesAction): JsonResponse
    {
        $deleteSeriesAction->execute($series);

        return response()->json();
    }
}
