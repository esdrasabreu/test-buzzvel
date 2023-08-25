<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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


Route::post('/users', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'getList']);
    Route::get('/tasks/{id}', [TaskController::class, 'get']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

    Route::get('/files', [FileController::class, 'getList']);
    Route::get('/files/{id}', [FileController::class, 'get']);
    Route::post('/files', [FileController::class, 'store']);
    Route::put('/files/{id}', [FileController::class, 'update']);
    Route::delete('/files/{id}', [FileController::class, 'destroy']);
});

Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
