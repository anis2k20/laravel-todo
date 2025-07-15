<x-app-layout>

<div style="width: 400px; margin: 0 auto; border: 1px solid black; padding: 10px;">
    <h2>Todo List</h2>
    <a href="{{ route('todos.create') }}">+ Add Todo</a>

<ol>
    @foreach ($todos as $todo)
    <li style="border: 1px dotted red; margin-bottom: 5px; padding: 5px;">
        <strong>{{$todo->title}}</strong>
        <p>{{$todo->description}}</p>
        <div style="display: flex; justify-content: space-between;">
            <span>{{$todo->is_completed ? 'Completed':'Pending'}}</span>
            <button>
            
            <a href="{{route('todos.edit', $todo->id)}}">Edit</a>    
            </button>
            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this todo?')">Delete</button>
            </form>
        </div>
    </li>
    @endforeach
</ol>
</div>
</x-app-layout>