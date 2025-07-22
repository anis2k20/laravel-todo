<x-app-layout>
<div class="max-w-screen-sm mx-auto mt-10 ">
   <form action="{{route('todos.store')}}" method="POST" class="space-y-4 bg-white p-10 card rounded-lg">
    @csrf
    <h1 class="text-center text-xl font-bold underline">Create a New Todo</h1>
    <div>
        <label class="form-label" for="title">Title:</label>
        <input class="form-input" type="text" name="title" id="title" value="{{ old('title') }}" required>
    </div>

    <div>
        <label class="form-label" for="description">Description:</label>
        <textarea rows="5" class="form-input" name="description" id="description">{{ old('description') }}</textarea>
    </div>

   <div class="w-full">
   <label class="form-label" for="priority">Priority</label>
   <select name="priority" id="priority" class="form-select w-full">
       <option value="low" selected>Low</option>
       <option value="medium">Medium</option>
       <option value="high">High</option>
   </select>
   </div>

   <div class="flex justify-end">
        <button class="btn" type="submit">Create Todo</button>
    </div>
   </form>
</div>
</x-app-layout>
