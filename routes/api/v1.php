<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\User\AuthenticationsController;
use App\Http\Controllers\API\V1\User\UsersController;
use App\Http\Controllers\API\V1\Shared\TimezonesController;

Route::prefix('v1')->group(function () {

    Route::post('/auth', AuthenticationsController::class)->name('auth');


    Route::get('/timezones', TimezonesController::class)->name('timezones');

    ///Protected Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(UsersController::class)->prefix('users')
            ->group(function () {
                Route::get('/profile', 'profile')->name('users.profile');
                Route::post('/profile', 'updateProfile')->name('users.updateProfile');
                Route::post('/avatar', 'updateAvatar')->name('users.updateAvatar');
            });

    });
});
