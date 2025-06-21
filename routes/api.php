<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', \App\Http\Controllers\API\ProductController::class);
    Route::apiResource('transactions', \App\Http\Controllers\API\StockTransactionController::class);
});
