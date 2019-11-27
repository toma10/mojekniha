<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Response;
use App\Actions\CreateEditionAction;
use App\Actions\DeleteEditionAction;
use App\Actions\UpdateEditionAction;
use App\Http\Requests\EditionRequest;
use App\Http\Resources\EditionResource;
use App\DataTransferObjects\EditionData;

class EditionsController extends Controller
{
    public function store(EditionRequest $request, CreateEditionAction $createEditionAction)
    {
        $edition = $createEditionAction->execute(
            new EditionData($request->validated())
        );

        return (new EditionResource($edition))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Edition $edition, EditionRequest $request, UpdateEditionAction $updateEditionAction)
    {
        $edition = $updateEditionAction->execute(
            $edition,
            new EditionData($request->validated())
        );

        return new EditionResource($edition);
    }

    public function destroy(Edition $edition, DeleteEditionAction $deleteEditionAction)
    {
        $deleteEditionAction->execute($edition);

        return response()->json();
    }
}
