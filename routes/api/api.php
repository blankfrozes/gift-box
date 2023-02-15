<?php

use Illuminate\Support\Facades\Route;

Route::get('/rewards', 'RewardController@index')->name('rewards');

Route::post('/voucher/use', 'VoucherController@getReward')->name('voucher-get-reward');

Route::post('/voucher/use/{id}', 'VoucherController@use')->name('voucher-use');
