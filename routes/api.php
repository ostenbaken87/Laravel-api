<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('tags', TagController::class);
    Route::apiResource('posts', PostController::class);
});
