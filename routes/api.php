<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->controller(UserController::class)->group(function () {
    Route::post('/signup', 'signup');
    Route::post('/signin', 'signin');
    Route::middleware('auth:sanctum')->post('/logout', 'logout');
});

Route::prefix('movie')->controller(MovieController::class)->group(function () {
    Route::middleware('auth:sanctum')->post('/create', 'create');
    Route::middleware('auth:sanctum')->post('/update', 'update');
    Route::middleware('auth:sanctum')->post('/findMovie', 'findMovie');
    Route::middleware('auth:sanctum')->post('/index', 'index');
    Route::middleware('auth:sanctum')->post('/delete', 'delete');
});