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


//auth
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('user/block/{id}', [UserController::class, 'block']);
Route::get('users', [UserController::class, 'index']);

//category
Route::apiResource('categories', CategoryController::class);

//Brands
Route::apiResource('brands', BrandController::class);

//product
Route::prefix('products')->group(function () {
    Route::resource('/', ProductController::class)
        ->parameters(['' => 'id'])
        ->only(['index', 'show', 'destroy']);
    Route::post('/store', [ProductController::class, 'store']);

    Route::post('/{id}/update', [ProductController::class, 'update']);
    Route::get('/index/trending', [ProductController::class, 'trendingIndex']);
    Route::get('/filter/category', [ProductController::class, 'productByCategory']);
    Route::get('/filter/brand', [ProductController::class, 'productByBrand']);
});

//order
Route::middleware('auth:sanctum')->prefix('orders')->group(function () {
    Route::apiResource('/', OrderController::class)->parameters(['' => 'id'])->except(['show']);
    Route::get('/user', [OrderController::class, 'show']);
    Route::post('/add-product-to-cart', [OrderController::class, 'addProductToOrder']);
    Route::post('/add-box-to-cart', [OrderController::class, 'addBoxToOrder']);
    Route::post('/send', [OrderController::class, 'sendOrder']);
});


//box
Route::apiResource('boxes', BoxController::class)->except('update');
Route::post('/boxes/{id}/update', [BoxController::class, 'update']);
