<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    public function store(request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            ]);

            $attributes['owner_id'] = Auth::id();

        Project::create($attributes);

        // this way also works
        // auth()->user()->projects()->create($attributes);

        return redirect('/projects');
    }

    public function edit(Project $project) {

        return view('projects.edit', compact('project'));

    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);

        $project->update($attributes);

        return redirect($project->path());
    }
}
