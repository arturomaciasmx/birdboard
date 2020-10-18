<x-app-layout>
    <x-slot name="header">
        <h1>Create new Project</h1>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="border-gray-400 border-solid shadow-lg max-w-lg mx-auto bg-white rounded p-4">
            <form method="POST" action="/projects" >
                @csrf
                <div class="pb-4">
                    <label for="title" class="mb-2 block">Title</label>
                    <input type="text" class="shadow w-full p-2" name="title">
                    @if ($errors->has('title'))
                        <span class="text-red-500">
                            {{ $errors->first('title') }}
                        </span>
                    @endif
                </div>
                <div class="pb-4">
                    <label for="description" class="mb-2 block">Description</label>
                    <textarea class="w-full shadow p-2" name="description"></textarea>
                    @if ($errors->has('description'))
                       <span class="text-red-500">
                           {{ $errors->first('description') }}
                       </span>
                   @endif
                </div>
                <div class="pb-4">
                    <input type="submit" value="Submit" class="py-2 px-4 rounded bg-blue-500 shadow text-white hover:bg-blue-800">
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
