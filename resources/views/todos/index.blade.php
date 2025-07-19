<x-app-layout>

<form action="{{route('todos.index')}}" class="max-w-[500px] mx-auto mt-10 space-y-4">
    <h2>Todo List</h2>
    <div class="flex justify-between">
    <a class="btn" href="{{ route('todos.create') }}">+ Add Todo</a>
    <button class="btn">
        <a href="{{route('todos.index', ['status'=>'null'])}}">All</a>
    </button>
        <button class="btn">
            <a href="#">Priority</a>
        </button>
    <button class="btn">
        <a href="{{route('todos.index', ['status'=>'pending'])}}">Pending</a>
    </button>
    <button class="btn">
        <a href="{{route('todos.index', ['status'=>'completed'])}}">Completed</a>
    </button>
    </div>
    {{--    search box  --}}
    <div class="flex items-center gap-4">
        <input type="search"
               name="search"
               value="{{request('search')}}"
               class="form-input"
               placeholder="Search todos...">
        <button class="btn-secondary">Search</button>
    </div>

<ol class="space-y-4">
    @foreach ($todos as $todo)
    <li class="card">
        <div class="flex justify-between items-center">
        <h3 class="card-header">{{$todo->title}}</h3>
            <span class="status-badge {{ $todo->is_completed ? 'status-completed' : 'status-pending' }}">
            {{ $todo->is_completed ? 'Completed' : 'Pending' }}</span>

        </div>
        <div class="flex justify-between items-start">

        <p class="card-body">{{$todo->description}}</p>
       <span class="status-badge {{$todo->priority === 'high' ? 'status-failed':'status-pending'}}">  {{$todo->priority}}</span>
        </div>

        <div class="card-footer flex justify-between items-center">
            <form action="{{route('todos.complete', $todo->id)}}" method="POST">
                @csrf
                @method('PATCH')
            <button class="btn-secondary">{{$todo->is_completed ? 'Back to Pending':'Done'}}</button>
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
</form>
</x-app-layout>
