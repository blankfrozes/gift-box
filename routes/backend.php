<?php

use Illuminate\Support\Facades\Route;

/*
 * Admin Routes
 */
Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified'],
], function () {
    includeRouteFiles(__DIR__.'/admin/');
});
