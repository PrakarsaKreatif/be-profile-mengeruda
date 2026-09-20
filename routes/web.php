<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'name' => 'Profile Backend API',
        'status' => 'running',
        'version' => app()->version(),
    ]);
});
