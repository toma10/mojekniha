<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Actions\CreateSeriesAction;
use App\Domain\Book\Actions\DeleteSeriesAction;
use App\Domain\Book\Actions\UpdateSeriesAction;
use App\Domain\Book\DataTransferObjects\SeriesData;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Series;
use App\Http\Requests\SeriesRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SeriesController
{
    public function index(): Response
    {
        $series = Series::paginate();

        return Inertia::render('Series/Index', compact('series'));
    }

    public function create(): Response
    {
        $authors = Author::all();

        return Inertia::render('Series/Create', compact('authors'));
    }

    public function store(SeriesRequest $request, CreateSeriesAction $createSeriesAction): RedirectResponse
    {
        $createSeriesAction->execute(SeriesData::fromRequest($request));

        flash()->success(trans('messages.series.created'));

        return redirect()->route('admin.books.series.index');
    }

    public function show(Series $series): Response
    {
        $series->load('author', 'books');

        return Inertia::render('Series/Show', compact('series'));
    }

    public function edit(Series $series): Response
    {
        $authors = Author::all();

        return Inertia::render('Series/Edit', compact('series', 'authors'));
    }

    public function update(
        Series $series,
        SeriesRequest $request,
        UpdateSeriesAction $updateSeriesAction
    ): RedirectResponse {
        $updateSeriesAction->execute($series, SeriesData::fromRequest($request));

        flash()->success(trans('messages.series.updated'));

        return redirect()->route('admin.books.series.edit', $series);
    }

    public function destroy(Series $series, DeleteSeriesAction $deleteSeriesAction): RedirectResponse
    {
        $deleteSeriesAction->execute($series);

        flash()->success(trans('messages.series.deleted'));

        return redirect()->route('admin.books.series.index');
    }
}
