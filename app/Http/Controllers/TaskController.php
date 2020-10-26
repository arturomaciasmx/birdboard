<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Project $project)
    {

        $this->authorize('update', $project);

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {

        $this->authorize('update', $project);

        $request = request()->validate([
            'body' => 'required',
            'completed' => 'sometimes'
        ]);


        $task->update($request);


        return redirect($project->path());
    }
}
