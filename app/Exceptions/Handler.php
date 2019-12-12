<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /** @var array<string> */
    protected $dontReport = [];

    /** @var array<string> */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
}
