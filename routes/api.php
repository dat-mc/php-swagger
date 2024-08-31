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

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('posts', PostController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
