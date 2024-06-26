<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:api')->prefix('posts')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\PostController::class, 'index']);
    Route::get('/{dummyId}', [\App\Http\Controllers\Api\PostController::class, 'getPostsByDummyId']);
    Route::post('/', [\App\Http\Controllers\Api\PostController::class, 'store']);
    Route::put('/{id}', [\App\Http\Controllers\Api\PostController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\Api\PostController::class, 'destroy']);
});
