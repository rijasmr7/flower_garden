<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GardeningController;
use App\Http\Controllers\inquiryController;
use App\Http\Controllers\MyCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PotController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('gardenings', GardeningController::class);
    Route::apiResource('inquiries', inquiryController::class);
    Route::apiResource('carts', MyCartController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('wishlists', WishlistController::class);
});
Route::apiResource('plants', PlantController::class);
Route::apiResource('pots', PotController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');