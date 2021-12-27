<?php

use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResendEmailVerificationController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\AuthorsController;
use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\EditionsController;
use App\Http\Controllers\Api\GenresController;
use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\NationalitiesController;
use App\Http\Controllers\Api\ReadingListItemController;
use App\Http\Controllers\Api\SeriesController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\UpdateProfileController;

Route::post('auth/register', RegisterController::class)->middleware('guest:api');
Route::post('auth/login', LoginController::class);
Route::post('auth/logout', LogoutController::class)->middleware('auth:api');

Route::post('auth/password/reset', ForgotPasswordController::class)->middleware('guest:api');
Route::post('auth/password/reset/{token}', ResetPasswordController::class)->middleware('guest:api');

Route::post('auth/email/verify', VerifyEmailController::class)->middleware('auth:api');
Route::post('auth/email/resend', ResendEmailVerificationController::class)->middleware('auth:api');

Route::get('me', MeController::class)->middleware('auth:api');
Route::put('me', UpdateProfileController::class)->middleware('auth:api');
Route::post('password', ChangePasswordController::class)->middleware('auth:api');

Route::get('authors', [AuthorsController::class, 'index']);
Route::get('authors/{author}', [AuthorsController::class, 'show']);
Route::get('books', [BooksController::class, 'index']);
Route::get('books/{book}', [BooksController::class, 'show']);
Route::get('editions/{edition}', [EditionsController::class, 'show']);
Route::get('genres/{genre}', [GenresController::class, 'show']);
Route::get('nationalities/{nationality}', [NationalitiesController::class, 'show']);
Route::get('series/{series}', [SeriesController::class, 'show']);
Route::get('tags/{tag}', [TagsController::class, 'show']);

Route::get('reading-list-items', [ReadingListItemController::class, 'index'])->middleware('auth:api');
Route::post('reading-list-items', [ReadingListItemController::class, 'store'])->middleware('auth:api');
Route::put('reading-list-items/{readingListItem}', [ReadingListItemController::class, 'update'])
    ->middleware('auth:api');
Route::delete('reading-list-items/{readingListItem}', [ReadingListItemController::class, 'destroy'])
    ->middleware('auth:api');
