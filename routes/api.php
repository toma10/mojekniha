<?php

use App\Http\Controllers\BooksController;

Route::get('books/{book}', [BooksController::class, 'show']);
Route::post('books', [BooksController::class, 'store']);
