<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\Api\UserController;

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

// Read User
// Route::get('/users/{id}', [UserController::class, 'show']);

// // Update User
// Route::put('/users/{id}', [UserController::class, 'update']);

// // Delete User
// Route::delete('/users/{id}', [UserController::class, 'destroy']);