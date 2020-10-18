<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Projects' }}
            </h2>
            <a href="/projects/create" class="text-blue-500 hover:text-blue-800 font-bold">Nuevo Projecto</a>
        </div>
    </x-slot>

    <div class="container mx-auto py-8">
        <ul>
            @forelse ($projects as $project)
                <li>
                    <a href="{{ $project->path() }}" class="hover:text-blue-500">
                        {{ $project->title }}</li>
                    </a>
            @empty
                <li>No projects jet</li>
            @endforelse
        </ul>
    </div>

</x-app-layout>
