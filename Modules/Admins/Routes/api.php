<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/admin', function (Request $request) {
    return $request->user();
});