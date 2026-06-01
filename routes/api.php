<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;

Route::post(
    '/login',
    [AuthController::class, 'login']
);

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get(
            '/todos',
            [TodoController::class, 'index']
        );

        Route::post(
            '/todos',
            [TodoController::class, 'store']
        );

        Route::post(
            '/logout',
            [AuthController::class, 'logout']
        );
    });
