<?php

use Illuminate\Support\Facades\Route;

/*
 * Admin Routes
 */
Route::middleware('auth:sanctum', config('jetstream.auth_session'), 'verified')->group(function () {
    includeRouteFiles(__DIR__.'/admin/');
});
