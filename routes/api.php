<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\Api\UserController;

Route::post('/users', [UserController::class, 'store']);

// Read All User Url
Route::get('/users', [UserController::class, 'showAllUser']);

// Read User Url by Id
Route::get('/users/{id}', [UserController::class, 'showUserById']);

// Update User by Id
Route::patch('/users/{id}', [UserController::class, 'update']);

// Delete User by Id
Route::delete('/users/{id}', [UserController::class, 'destroy']);
