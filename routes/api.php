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


// Create User Url
Route::post('/users', [UserController::class, 'store']);

// Read All User Url
Route::get('/users', [UserController::class, 'showAllUser']);

// Read User Url by Id
Route::get('/users/{id}', [UserController::class, 'showUserById']);

// // Update User
// Route::put('/users/{id}', [UserController::class, 'update']);

// // Delete User
// Route::delete('/users/{id}', [UserController::class, 'destroy']);