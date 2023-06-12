<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\NewsController;
use \App\Http\Controllers\AppController;

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
Route::get('news', [NewsController::class, 'index'])->name('news');
Route::get('app-settings', [AppController::class, 'index'])->name('app-settings');

Route::prefix('auth/')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::middleware('auth:sanctum')->group(function(){
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware('auth:sanctum')
    ->prefix('user')
    ->group(function(){
        Route::get('/me', [UserController::class, 'index'])->name('user.me');
        Route::get('/news', [NewsController::class, 'index'])->name('user.news');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile');
        Route::put('/preference', [UserController::class, 'updatePreference'])->name('user.preference');
    });

