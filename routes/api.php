<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MockPaymentController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/auth', [AuthController::class, 'login']);

Route::get('/categories', [ShopController::class, 'categories']);
Route::get('/categories/{category}/products', [ShopController::class, 'products']);
Route::get('/products/{product}', [ShopController::class, 'showProduct']);
Route::post('/payment-webhook', [WebhookController::class, 'handleInternal'])->name('payment-webhook');
Route::post('/payments', [MockPaymentController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/products/{product}/buy', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});
