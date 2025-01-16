<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo; // Ensure the correct model is imported

class TodoController extends Controller
{
    // Display a listing of todos
    public function index()
    {
        $todos = Todo::orderBy('completed')->get(); // Get todos, prioritize incomplete tasks
        return view('todos.index', compact('todos'));
    }

    // Store a new todo
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Todo::create(['title' => $request->title]);

        return redirect()->route('todos.index');
    }

    // Update an existing todo (Complete or Undo)
    public function update(Request $request, Todo $todo)
    {
        
        $todo->completed = !$todo->completed; // Toggle the boolean value
        $todo->save(); // Save the updated todo

        return response()->json(['success' => true]);
    }

    // Edit a todo (for changing the title)
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    // Update the title of a todo
    public function updateTitle(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo->update([
            'title' => $request->title,
        ]);

        return redirect()->route('todos.index');
    }

    // Destroy (delete) a todo
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }
}
