<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//category
Route::apiResource('categories', CategoryController::class);

//product
Route::apiResource('products', ProductController::class);
