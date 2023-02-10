<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}', function () {
    return view('index');
})->where("any",".*");

// /*
//  * Admin Routes
//  */
// Route::group([
//   'namespace' => 'Admin',
//   'prefix' => 'admin',
//   'middleware' => ['auth:sanctum'],
// ], function () {
//   includeRouteFiles(__DIR__ . '/admin/');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
