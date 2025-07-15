<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        Todo::create($request->only('title','description'));

        return redirect()->route('todos.index')->with('success', 'todo created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTodoRequest $request, Todo $todo)
    {
        $todo->update($request->only('title','description'));

        return redirect()->route('todos.index')->with('success', 'todo update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(int $id)
//    {
//        $todo = Todo::findOrFail($id);
//        $todo->delete();
//        return redirect()->back()->with('success', 'todo delete successfully');
//    }
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('success', 'Todo deleted successfully.');
    }

    function complete(Todo $todo)
    {
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
        return redirect()->back()->with('success', 'Todo status updated successfully.');
    }
}
