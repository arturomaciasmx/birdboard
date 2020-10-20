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
        if(auth()->user()->isNot($project->owner)) {
            abort(403);
        }

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
}
