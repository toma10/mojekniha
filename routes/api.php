<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\AuthorsController;

Route::get('books/{book}', [BooksController::class, 'show']);
Route::post('books', [BooksController::class, 'store']);
Route::put('books/{book}', [BooksController::class, 'update']);
Route::delete('books/{book}', [BooksController::class, 'destroy']);

Route::get('authors/{author}', [AuthorsController::class, 'show']);
Route::post('authors', [AuthorsController::class, 'store']);
Route::put('authors/{author}', [AuthorsController::class, 'update']);
Route::delete('authors/{author}', [AuthorsController::class, 'destroy']);

Route::get('genres/{genre}', [GenresController::class, 'show']);
Route::post('genres', [GenresController::class, 'store']);
Route::put('genres/{genre}', [GenresController::class, 'update']);
Route::delete('genres/{genre}', [GenresController::class, 'destroy']);
