<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Project $project) {
        // dd(request('body'));

        $atributes = request()->validate(['body' => 'required']);

        $project->addTask(request('body'));
    }
}
