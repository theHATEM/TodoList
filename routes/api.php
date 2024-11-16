<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TodoItem;
use App\Http\Controllers\TodoItemsController; 
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test', function () {
    return [
        'message' => 'test1234', 
    ];
}); 


Route::get('/items', [TodoItemsController::class, 'getAll']);
Route::post('/create-item', [TodoItemsController::class, 'store'])->middleware('auth:api'); 
Route::get('/get-items', [TodoItemsController::class, 'showAllItems'])->middleware('auth:api'); 
Route::get('/item/{id}', [TodoItemsController::class, 'show']);
Route::delete('/item/{id}', [TodoItemsController::class, 'deleteItem'])->middleware('auth:api');
Route::put('/item/{id}', [TodoItemsController::class, 'updateItem'])->middleware('auth:api');



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});