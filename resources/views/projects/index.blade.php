<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl text-gray-400">
                {{ 'Projects' }}
            </h2>
            <a href="/projects/create" class="btn btn-blue">Nuevo Projecto</a>
        </div>
    </x-slot>

    <div class="container mx-auto py-4">

        <div class="projects-container flex flex-wrap -mx-4">
            @forelse ($projects as $project)
            <div class="lg:w-1/3 md:w-1/2 w-full p-4">
                <div class="rounded-lg shadow bg-white p-4 h-48">
                    <h3 class="border-l-4 border-blue-500 -ml-4 pl-4 mb-4">
                        <a href="{{ $project->path() }}" class="hover:text-gray-400">
                            {{ $project->title }}</h3>
                        </a>
                    <div>
                        <p class="text-gray-500">
                            {{ Str::limit($project->description, 300) }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
                <li>No projects jet</li>
            @endforelse
        </div> {{-- project container --}}

    </div>

</x-app-layout>
