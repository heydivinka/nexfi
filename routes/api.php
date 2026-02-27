<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::apiResource('transactions', TransactionApiController::class);
Route::apiResource('categories', CategoryApiController::class);