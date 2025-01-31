<?php

use App\Http\Controllers\Subscription\ConfirmSubscriptionController;
use App\Http\Controllers\Subscription\IndexController;
use App\Http\Controllers\Subscription\SubscribeController;
use App\Http\Controllers\Subscription\SubscriptionSuccessfulController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class);
Route::post('/subscribe', SubscribeController::class);
Route::get('/s/confirm/{token}', ConfirmSubscriptionController::class);
Route::get('/success/{token}', SubscriptionSuccessfulController::class);
