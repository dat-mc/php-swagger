<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
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

Route::post('sign-in', [UserController::class, 'signIn']);
Route::post('sign-up', [UserController::class, 'signUp']);
Route::middleware('auth:sanctum')->get('logout', [UserController::class, 'logout']);

Route::get('posts', [PostController::class, 'index']);
Route::get('post/{id}', [PostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('post', [PostController::class, 'store']);
    Route::put('post', [PostController::class, 'update']);
    Route::delete('post/{id}', [PostController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
