<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('paypal')->group(function () {
    Route::post('order/create', [OrderController::class, 'create']);
    Route::post('order/{id}/capture', [OrderController::class, 'capture']);
});
