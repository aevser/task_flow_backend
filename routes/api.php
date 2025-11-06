<?php

use App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [V1\AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('projects/{project}')->group(function () {
            Route::get('tasks', [V1\Task\TaskController::class, 'index']);

            Route::post('tasks', [V1\Task\TaskController::class, 'store']);
        });

        Route::get('tasks/{id}', [V1\Task\TaskController::class, 'show']);

        Route::patch('tasks/{id}', [V1\Task\TaskController::class, 'update']);

        Route::delete('tasks/{id}', [V1\Task\TaskController::class, 'destroy']);

        Route::post('logout', [V1\AuthController::class, 'logout']);
    });
});
