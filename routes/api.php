<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;

// Public Routes
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LogoutController::class, 'logout']);

// Item Routes
Route::post('/add-item', [ItemController::class, 'store']);
Route::get('/items', [ItemController::class, 'index']);
Route::get('/item', function () {
    return ['item' => Item::all()]; // Changed Items to Item
})->name('edit');

// User Routes
Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'getUserById']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
