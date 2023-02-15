<?php

use App\Http\Controllers\RewardController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('/rewards', [RewardController::class, 'index'])->name('rewards');

Route::post('/voucher/use', [VoucherController::class, 'getReward'])->name('voucher-get-reward');

Route::post('/voucher/use/{id}', [VoucherController::class, 'use'])->name('voucher-use');
