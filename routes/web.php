<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Models\Todo;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    // Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
    // Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::delete('/todos/{todo}', function (Todo $todo) {
        dd($todo);
    });
    

    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todos/{todo}', [TodoController::class, 'show'])->name('todos.show');
    Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');

    // Route::resource('todos', TodoController::class)->names([
    //     'index'   => 'todo.index',
    //     'create'  => 'todo.create',
    //     'store'   => 'todo.store',
    //     'show'    => 'todo.show',
    //     'edit'    => 'todo.edit',
    //     'update'  => 'todo.update',
    //     'destroy' => 'todo.destroy',
    // ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
