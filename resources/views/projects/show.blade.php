<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <p class=" text-lg text-gray-400">
                <a href="/projects">
                    My projects
                </a> / {{ $project->title }}
            </p>
            <a href="#" class=" btn btn-blue">New Project</a>
        </div>
    </x-slot>


    <div class="container mx-auto py-8">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-2/3 md:w-2/4 px-4">
                    <div class="pb-8">
                        <h2 class="text-gray-400 text-2xl mb-2">Tasks</h2>
                        <div class="card">
                            Lorem ipsum dolor sit amet consectetur
                        </div>
                    </div>
                    <div>
                        <h2 class=" text-gray-400 text-2xl mb-2">General Notes</h2>
                        <textarea class="card w-full h-48">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis provident, dolores laborum facere quidem corrupti! Cupiditate sapiente aliquam expedita. Corrupti temporibus inventore illo est, repudiandae atque nesciunt ab tempore consequuntur?</textarea>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 md:w-2/4 px-4">
                    <livewire:card :project="$project"/>
                </div>
            </div>
        </div>
</x-app-layout>
