<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TodoItem;
use App\Http\Controllers\TodoItemsController; 


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test', function () {
    return [
        'message' => 'test1234', 
    ];
}); 

Route::get('/items', [TodoItemsController::class, 'getAll']);
Route::post('/create-item', [TodoItemsController::class, 'store']); 
Route::get('/item/{id}', [TodoItemsController::class, 'show']);
Route::delete('/item/{id}', [TodoItemsController::class, 'deleteItem']);
Route::put('/item/{id}', [TodoItemsController::class, 'updateItem']);