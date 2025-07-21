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
        $sortByPriority = $request->query('sort_by_priority');
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
        if ($sortByPriority) {
            $priorityOrder = [
                'high' => 1,
                'medium' => 2,
                'low' => 3,
            ];
            $todos = $todos->sortBy(function ($todo) use ($priorityOrder) {
                return $priorityOrder[$todo->priority] ?? 4; // Default to 4 if priority is not set
            })->values();
        }


        return view('todos.index',compact('todos', 'search', 'status', 'sortByPriority'));
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
