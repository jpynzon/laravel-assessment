<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Models\Item;

Route::post('api/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);


Route::post('/add-item', [ItemController::class, 'store']);
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
Route::put('/item/{id}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

Route::get('/items', [ItemController::class, 'index']);
Route::get('/item', function () {
    return response()->json(['item' => Item::all()]);
})->name('edit');

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');