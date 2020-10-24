<div class="pb-4">
    <label for="title" class="mb-2 block text-gray-500">Title</label>
    <input type="text" class="shadow border rounded w-full p-2 focus:border-blue-500" name="title" value="{{ $project->title }}">
    @if ($errors->has('title'))
        <span class="text-red-500">
            {{ $errors->first('title') }}
        </span>
    @endif
</div>
<div class="pb-4">
    <label for="description" class="mb-2 block text-gray-500">Description</label>
    <textarea class="w-full shadow border rounded p-2" name="description">{{ $project->description }}</textarea>
    @if ($errors->has('description'))
       <span class="text-red-500">
           {{ $errors->first('description') }}
       </span>
   @endif
</div>
<div class="pb-4">
    <input type="submit" value="{{ $button }}" class="py-2 px-4 rounded bg-blue-500 shadow-lg text-white hover:bg-blue-800">
</div>
