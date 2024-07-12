<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mime\MessageConverter;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::get('/user/random', [UserController::class, 'getRandomUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('/chat', ChatController::class);
    Route::post('/message', [MessageController::class, 'store']);
    Route::get('/message/{chatId}', [MessageController::class, 'index']);
});

Route::post('/upload', [FileController::class, 'upload']);
