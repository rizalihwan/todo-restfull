<?php

use App\Http\Controllers\Api\{RegisterController, LoginController, TodoController};

Route::post('/register/account', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::get('/me', [LoginController::class, 'me']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/todo/index', [TodoController::class, 'index']);
    Route::post('/todo/store', [TodoController::class, 'store']);
    Route::delete('/todo/{todo}/delete', [TodoController::class, 'destroy']);
    Route::patch('/todo/{todo}/update', [TodoController::class, 'update']);
});