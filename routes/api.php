<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\TestimonialController;

// API routes for testimonials
Route::post('/testimonials', [TestimonialController::class, 'store']);
Route::get('/testimonials', [TestimonialController::class, 'approved']);

// API routes for messages
Route::post('/messages', [MessageController::class, 'store']);
Route::get('/messages', [MessageController::class, 'index']);

// API routes for transactions and categories
Route::apiResource('transactions', TransactionApiController::class);
Route::apiResource('categories', CategoryApiController::class);