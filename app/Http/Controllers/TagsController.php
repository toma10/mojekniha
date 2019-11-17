<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Response;
use App\Actions\CreateTagAction;
use App\Actions\DeleteTagAction;
use App\Actions\UpdateTagAction;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\DataTransferObjects\TagData;

class TagsController
{
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function store(TagRequest $request, CreateTagAction $createTagAction)
    {
        $tag = $createTagAction->execute(
            new TagData($request->validated())
        );

        return (new TagResource($tag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Tag $tag, TagRequest $request, UpdateTagAction $updateTagAction)
    {
        $updateTagAction->execute(
            $tag,
            new TagData($request->validated())
        );

        return new TagResource($tag);
    }

    public function destroy(Tag $tag, DeleteTagAction $deleteTagAction)
    {
        $deleteTagAction->execute($tag);

        return response()->json();
    }
}
