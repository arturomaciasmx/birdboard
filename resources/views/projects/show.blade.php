<x-app-layout>
    <x-slot name="header">
        <h1>{{ $project->title }}</h1>
    </x-slot>


    <div class="container mx-auto py-8">
        {{ $project->description }}
    </div>
</x-app-layout>
