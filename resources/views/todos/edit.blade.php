<h2>Edidt Todo</h2>

@if($errors->any())
<ul>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    <li></li>
</ul>
@endif

<form action="{{route('todos.update', $todo)}}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $todo->title) }}" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ old('description', $todo->description) }}</textarea>
    </div>

    <div>
        <button type="submit">Update Todo</button>
    </div>
</form>