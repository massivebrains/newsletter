<?php

use App\Http\Controllers\Subscription\IndexController;
use App\Http\Controllers\Subscription\SubscribeController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class);
Route::post('/subscribe', SubscribeController::class);
Route::view('/success', 'success');
