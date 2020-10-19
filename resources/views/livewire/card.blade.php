<div class="card-project">
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
