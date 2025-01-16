<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Display list of todos
Route::get('/', [TodoController::class, 'index'])->name('todos.index');

// Store a new todo
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');

// Update a todo's completion status (Complete/Undo)
Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');

// Edit a todo's title
Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');

// Update a todo's title after editing
Route::put('/todos/{todo}/updateTitle', [TodoController::class, 'updateTitle'])->name('todos.updateTitle');

// Delete a todo
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');