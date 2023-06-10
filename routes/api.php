<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\NewsController;

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
Route::get('news', [NewsController::class, 'index']);
Route::get('app-settings', [\App\Http\Controllers\AppController::class, 'index']);

Route::prefix('auth/')->group(function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->group(function(){
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')
    ->prefix('user')
    ->group(function(){
        Route::get('/me', [UserController::class, 'index']);
        Route::get('/news', [NewsController::class, 'index']);
        Route::put('/profile', [UserController::class, 'updateProfile']);
        Route::put('/preference', [UserController::class, 'updatePreference']);
    });

