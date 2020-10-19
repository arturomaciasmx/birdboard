<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <p class="text-lg text-gray-400">
                My projects
            </p>
            <a href="/projects/create" class="btn btn-blue">Nuevo Projecto</a>
        </div>
    </x-slot>

    <div class="container mx-auto py-4">

        <div class="projects-container flex flex-wrap items-stretch -mx-4">
            @forelse ($projects as $project)
            <div class="lg:w-1/3 md:w-1/2 w-full p-4">
                <livewire:card :project="$project"/>
            </div>
            @empty
                <li>No projects jet</li>
            @endforelse
        </div> {{-- project container --}}

    </div>

</x-app-layout>
