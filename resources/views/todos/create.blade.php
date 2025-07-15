<x-app-layout>
<div>
   <form action="{{route('todos.store')}}" method="POST">
    @csrf

    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <button type="submit">Create Todo</button>
    </div>
   </form>
</div>
</x-app-layout>
