<?php

use Illuminate\Support\Facades\Route;


Route::get('/rewards', 'RewardController@index')->name('rewards');

// Route::get('/reward', 'AdminController@reward')->name('reward');

// Route::get('/profile', 'AdminController@profile')->name('profile');