<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', 'AdminController@voucher')->name('dashboard');

Route::get('/reward', 'AdminController@reward')->name('reward');

Route::get('/profile', 'AdminController@profile')->name('profile');
