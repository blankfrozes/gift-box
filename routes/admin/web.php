<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AdminController::class, 'voucher'])->name('dashboard');

Route::get('/reward', [AdminController::class, 'reward'])->name('reward');

Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
