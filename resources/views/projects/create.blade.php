<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="border-gray-400 border-solid shadow-lg max-w-lg mx-auto bg-white rounded-lg p-4">
            <h1 class="text-center mb-4 text-gray-500 text-2xl">Create new Project</h1>
            <form method="POST" action="/projects" >
                @csrf
                @include('projects._form', ['project' => new App\Models\Project, 'button' => 'Create Project'])
            </form>
        </div>
    </div>

</x-app-layout>
