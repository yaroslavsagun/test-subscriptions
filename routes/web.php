<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [SubscriptionController::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix'=> 'subscription'], function() {
        Route::post('/update', [SubscriptionController::class, 'update'])->name('subscription.update');
    });
});
