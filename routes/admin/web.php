<?php

use Illuminate\Support\Facades\Route;


Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

Route::get('/reward', 'AdminController@reward')->name('reward');
