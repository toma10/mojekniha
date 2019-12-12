<?php

Route::get('/', static function () {
    return response()->json(['status' => 'OK']);
});
