<?php

namespace App\Http\Controllers;

use App\Actions\CreateEditionAction;
use App\Actions\DeleteEditionAction;
use App\Actions\UpdateEditionAction;
use App\DataTransferObjects\EditionData;
use App\Http\Requests\EditionRequest;
use App\Http\Resources\EditionResource;
use App\Models\Edition;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class EditionsController
{
    public function store(EditionRequest $request, CreateEditionAction $createEditionAction): JsonResponse
    {
        $edition = $createEditionAction->execute(
            new EditionData($request->validated())
        );

        return (new EditionResource($edition))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(
        Edition $edition,
        EditionRequest $request,
        UpdateEditionAction $updateEditionAction
    ): JsonResource {
        $edition = $updateEditionAction->execute(
            $edition,
            new EditionData($request->validated())
        );

        return new EditionResource($edition);
    }

    public function destroy(Edition $edition, DeleteEditionAction $deleteEditionAction): JsonResponse
    {
        $deleteEditionAction->execute($edition);

        return response()->json();
    }
}
