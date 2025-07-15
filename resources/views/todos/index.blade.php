<x-app-layout>

<div class="max-w-[500px] mx-auto mt-10 space-y-4">
    <h2>Todo List</h2>
    <div class="flex justify-between">
    <a class="btn" href="{{ route('todos.create') }}">+ Add Todo</a>
    <button class="btn">All</button>
    <button class="btn-secondary">Pending</button>
    <button class="btn">Completed</button>
    </div>

<ol class="space-y-4">
    @foreach ($todos as $todo)
    <li class="card">
        <h3 class="card-header">{{$todo->title}}</h3>
        <p class="card-body">{{$todo->description}}</p>
        <div class="card-footer flex justify-between items-center">
            <form action="{{route('todos.complete', $todo->id)}}" method="POST">
                @csrf
                @method('PATCH')
            <button class="btn-secondary">{{$todo->is_completed ? 'Completed':'Pending'}}</button>
            </form>
            <button class="btn">
            <a href="{{route('todos.edit', $todo->id)}}">Edit</a>
            </button>
            <form action="{{ route('todos.destroy', $todo->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this todo?')">Delete</button>
            </form>
        </div>
    </li>
    @endforeach
</ol>
</div>
</x-app-layout>
