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

        <div class="projects-container flex flex-wrap">
            @forelse ($projects as $project)
            <div class="lg:w-1/3 md:w-1/2 w-full p-4">
                <div class="rounded shadow bg-white py-4 h-48">
                    <h3 class="mb-4 border-l-4 border-solid border-blue-500 px-4">{{ $project->title }}</h3>
                    <div class="px-4">
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
