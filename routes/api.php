<?php

use App\Http\Controllers\TagsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\AuthorsController;

Route::get('books/{book}', [BooksController::class, 'show']);
Route::post('books', [BooksController::class, 'store']);
Route::put('books/{book}', [BooksController::class, 'update']);
Route::delete('books/{book}', [BooksController::class, 'destroy']);

Route::get('authors/{author}', [AuthorsController::class, 'show']);
Route::post('authors', [AuthorsController::class, 'store']);
Route::put('authors/{author}', [AuthorsController::class, 'update']);
Route::delete('authors/{author}', [AuthorsController::class, 'destroy']);

Route::get('series/{series}', [SeriesController::class, 'show']);
Route::post('series', [SeriesController::class, 'store']);
Route::put('series/{series}', [SeriesController::class, 'update']);
Route::delete('series/{series}', [SeriesController::class, 'destroy']);

Route::get('genres/{genre}', [GenresController::class, 'show']);
Route::post('genres', [GenresController::class, 'store']);
Route::put('genres/{genre}', [GenresController::class, 'update']);
Route::delete('genres/{genre}', [GenresController::class, 'destroy']);

Route::get('tags/{tag}', [TagsController::class, 'show']);
Route::post('tags', [TagsController::class, 'store']);
Route::put('tags/{tag}', [TagsController::class, 'update']);
Route::delete('tags/{tag}', [TagsController::class, 'destroy']);
