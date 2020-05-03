<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Book\Models\Nationality;
use Inertia\Inertia;
use Inertia\Response;

class NationalitiesController
{
    public function index(): Response
    {
        $nationalities = Nationality::paginate();

        return Inertia::render('Nationalities/Index', compact('nationalities'));
    }

    public function show(Nationality $nationality): Response
    {
        $nationality->load('authors');

        return Inertia::render('Nationalities/Show', compact('nationality'));
    }
}
