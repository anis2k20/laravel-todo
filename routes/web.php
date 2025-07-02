<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);
Route::resource('todos', (TodoController::class));
/*
Route::get('todos', [TodoController::class, 'index']);        // Show all todos
Route::get('todos/create', [TodoController::class, 'create']); // Show form to create a new todo
Route::post('todos', [TodoController::class, 'store']);        // Store a new todo
Route::get('todos/{todo}', [TodoController::class, 'show']);   // Show a single todo
Route::get('todos/{todo}/edit', [TodoController::class, 'edit']); // Show form to edit a todo
Route::put('todos/{todo}', [TodoController::class, 'update']);    // Update a todo
Route::delete('todos/{todo}', [TodoController::class, 'destroy']); // Delete a todo
*/