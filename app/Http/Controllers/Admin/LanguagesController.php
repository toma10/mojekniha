<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Models\Language;
use Inertia\Inertia;
use Inertia\Response;

class LanguagesController
{
    public function index(): Response
    {
        $languages = Language::paginate();

        return Inertia::render('Languages/Index', compact('languages'));
    }

    public function show(Language $language): Response
    {
        $language->load('editions.book');

        return Inertia::render('Languages/Show', compact('language'));
    }
}
