<?php

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

Route::middleware('json.response')->prefix('v1')->group(function() {
    Route::middleware('auth:sanctum')->group(function() {
        Route::apiResource('tasks', \App\Http\Controllers\todo\TaskController::class)
            ->only(['store', 'update', 'destroy']);
    });

    Route::apiResource('tasks', \App\Http\Controllers\todo\TaskController::class)
        ->only('index', 'show');
});git init
