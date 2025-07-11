<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api'); 
 
Route::apiResource('categories', \App\Http\Controllers\Api\V1\CategoryController::class)
    ->middleware('auth:sanctum');
        
Route::get('products', [\App\Http\Controllers\Api\V1\ProductController::class, 'index']); 