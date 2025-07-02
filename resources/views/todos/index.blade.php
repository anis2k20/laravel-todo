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
            <button>Delete</button>
        </div>
    </li>
    @endforeach
</ol>
</div>
