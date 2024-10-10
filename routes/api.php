<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix'=> 'subscription'], function() {
        Route::get('/all', [SubscriptionController::class, 'get']);
        Route::get('/current', [SubscriptionController::class, 'getCurrent']);
        Route::post('/update', [SubscriptionController::class, 'update']);
    });
});
