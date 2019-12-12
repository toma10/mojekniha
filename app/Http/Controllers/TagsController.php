<?php

namespace App\Http\Controllers;

use App\Actions\CreateTagAction;
use App\Actions\DeleteTagAction;
use App\Actions\UpdateTagAction;
use App\DataTransferObjects\TagData;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TagsController
{
    public function show(Tag $tag): JsonResource
    {
        return new TagResource($tag);
    }

    public function store(TagRequest $request, CreateTagAction $createTagAction): JsonResponse
    {
        $tag = $createTagAction->execute(
            new TagData($request->validated())
        );

        return (new TagResource($tag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Tag $tag, TagRequest $request, UpdateTagAction $updateTagAction): JsonResource
    {
        $updateTagAction->execute(
            $tag,
            new TagData($request->validated())
        );

        return new TagResource($tag);
    }

    public function destroy(Tag $tag, DeleteTagAction $deleteTagAction): JsonResponse
    {
        $deleteTagAction->execute($tag);

        return response()->json();
    }
}
