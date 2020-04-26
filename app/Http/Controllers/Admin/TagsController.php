<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Actions\CreateTagAction;
use App\Domain\Book\Actions\DeleteTagAction;
use App\Domain\Book\Actions\UpdateTagAction;
use App\Domain\Book\DataTransferObjects\TagData;
use App\Domain\Book\Models\Tag;
use App\Http\Requests\TagRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TagsController
{
    public function index(): Response
    {
        $tags = Tag::paginate();

        return Inertia::render('Tags/Index', compact('tags'));
    }

    public function create(): Response
    {
        return Inertia::render('Tags/Create');
    }

    public function store(TagRequest $request, CreateTagAction $createTagAction): RedirectResponse
    {
        $createTagAction->execute(
            new TagData($request->validated())
        );

        flash()->success(trans('messages.tag.created'));

        return redirect()->route('admin.books.tags.index');
    }

    public function show(Tag $tag): Response
    {
        return Inertia::render('Tags/Show', compact('tag'));
    }

    public function edit(Tag $tag): Response
    {
        return Inertia::render('Tags/Edit', compact('tag'));
    }

    public function update(Tag $tag, TagRequest $request, UpdateTagAction $updateTagAction): RedirectResponse
    {
        $updateTagAction->execute(
            $tag,
            new TagData($request->validated())
        );

        flash()->success(trans('messages.tag.updated'));

        return redirect()->route('admin.books.tags.edit', $tag);
    }

    public function destroy(Tag $tag, DeleteTagAction $deleteTagAction): RedirectResponse
    {
        $deleteTagAction->execute($tag);

        flash()->success(trans('messages.tag.deleted'));

        return redirect()->route('admin.books.tags.index');
    }
}
