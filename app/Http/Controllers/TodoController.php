<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->input('search');
        $todos = Todo::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($status === 'completed', function($query){
                return $query->where('is_completed', true);
            })
            ->when($status === 'pending', function($query){
                return $query->where('is_completed', false);
            })
            ->get();

        return view('todos.index',compact('todos', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    public function store(StoreTodoRequest $request)
    {
        Todo::create($request->only('title','description','priority'));

        return redirect()->route('todos.index')->with('success', 'todo created successfully');
    }

    public function show(Todo $todo)
    {
        //
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(StoreTodoRequest $request, Todo $todo)
    {
        $todo->update($request->only('title','description'));

        return redirect()->route('todos.index')->with('success', 'todo update successfully');
    }


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
