<?php

use App\Http\Controllers\Admin\Auth\LoginController;

use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])
        ->name('admin.register');
    Route::post('register', [RegisteredAdminController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])
        ->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);

});



