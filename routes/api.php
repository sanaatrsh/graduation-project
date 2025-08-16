<?php

use App\Http\Controllers\BoxController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Box;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//auth
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

//category
Route::apiResource('categories', CategoryController::class);

//Brands
Route::apiResource('brands', BrandController::class);

//product
Route::prefix('products')->group(function () {
    Route::resource('/', ProductController::class)
        ->parameters(['' => 'id'])
        ->only(['index', 'store', 'show', 'destroy']);

    Route::post('/{id}/update', [ProductController::class, 'update']);
    Route::get('/trending', [ProductController::class, 'trendingIndex']);
    Route::get('/category', [ProductController::class, 'productByCategory']);
});

//order
Route::apiResource('orders', OrderController::class);
//box
Route::apiResource('boxes', BoxController::class);
//payment
Route::apiResource('payments', PaymentController::class);
//delivery
Route::apiResource('deliveries', DeliveryController::class);
