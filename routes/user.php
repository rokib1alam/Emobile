<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('profile', ProfileController::class)->only(['update','destroy']);

});

