<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <p class=" text-lg text-gray-400">
                <a href="/projects">
                    My projects
                </a> / {{ $project->title }}
            </p>
            <a href="#" class=" btn btn-blue">Add Task</a>
        </div>
    </x-slot>


    <div class="container mx-auto py-8">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-2/3 md:w-2/4 px-4">
                    <div class="pb-8">
                        <h2 class="text-gray-400 text-2xl mb-2">Tasks</h2>
                        @forelse ($project->tasks as $task)

                            <div class="card mb-3">
                                <form action="{{ $project->path() . '/tasks/' . $task->id  }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="flex">
                                        <input type="text" name="body" class="w-full {{ $task->completed ? 'text-gray-400' : ''}}" value="{{ $task->body }}">
                                        <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : ''}} class="h-6 w-5">
                                    </div>
                                </form>
                            </div>

                        @empty

                            <p class=" text-gray-400">No tasks yet</p>

                        @endforelse

                        <div class="card">
                            <form action="{{ $project->path() . '/tasks' }}" method="POST">
                                @csrf
                                <input type="text" name="body" class="w-full" placeholder="Add new task...">
                            </form>
                        </div>

                    </div>
                    <div>
                        <h2 class=" text-gray-400 text-2xl mb-2">General Notes</h2>
                        <form action="{{ $project->path() }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <textarea class="card w-full h-48" name="notes">{{ $project->notes }}</textarea>
                            <input type="submit" value="Save" class="btn btn-blue">
                        </form>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 md:w-2/4 px-4">
                    <livewire:card :project="$project"/>
                    <div class="card mt-3">
                        <ul class="text-sm space-y-1">
                            @foreach ($project->activity as $activity)
                            <li>
                                @include('projects.activity.' . $activity->description)
                                <span class="text-gray-400">{{ $activity->created_at->diffForHumans() }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
