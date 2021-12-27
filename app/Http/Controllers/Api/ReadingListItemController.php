<?php

namespace App\Http\Controllers\Api;

use App\Domain\Book\Actions\CreateReadingListItemAction;
use App\Domain\Book\Actions\UpdateReadingListItemAction;
use App\Domain\Book\DataTransferObjects\CreateReadingListItemData;
use App\Domain\Book\DataTransferObjects\UpdateReadingListItemData;
use App\Domain\Book\Models\ReadingListItem;
use App\Http\Requests\CreateReadingListItemRequest;
use App\Http\Requests\DeleteReadingListItemRequest;
use App\Http\Requests\UpdateReadingListItemRequest;
use App\Http\Resources\ReadingListItemResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadingListItemController
{
    public function index(Request $request): JsonResource
    {
        $readingListItems = $request->user()->readingListItems()->with('book')->get();

        return ReadingListItemResource::collection($readingListItems);
    }

    public function store(
        CreateReadingListItemRequest $request,
        CreateReadingListItemAction $createReadingListItemAction
    ): JsonResource {
        $readingListItem = $createReadingListItemAction->execute(
            $request->user(),
            new CreateReadingListItemData($request->validated())
        );

        $readingListItem->load('book');

        return new ReadingListItemResource($readingListItem);
    }

    public function update(
        UpdateReadingListItemRequest $request,
        ReadingListItem $readingListItem,
        UpdateReadingListItemAction $updateReadingListItemAction
    ): JsonResource {
        $readingListItem = $updateReadingListItemAction->execute(
            $readingListItem,
            new UpdateReadingListItemData($request->validated())
        );

        $readingListItem->load('book');

        return new ReadingListItemResource($readingListItem);
    }

    public function destroy(DeleteReadingListItemRequest $request, ReadingListItem $readingListItem): JsonResponse
    {
        $readingListItem->delete();

        return response()->json();
    }
}
