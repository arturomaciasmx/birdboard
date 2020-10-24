<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="border-gray-400 border-solid shadow-lg max-w-lg mx-auto bg-white rounded-lg p-4">
            <h1 class="text-center mb-4 text-gray-500 text-2xl">Edit Project</h1>
            <form method="POST" action="{{ $project->path() }}" >
                @csrf
                @method('PATCH')
                @include('projects._form', ['button' => 'Update Project'])
            </form>
        </div>
    </div>

</x-app-layout>
