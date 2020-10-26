<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Static_;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['project'];


    public static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            $task->project->recordActivity('task_created');
        });

        static::updated(function ($task) {

            $task->project->recordActivity('task_updated');

            if ($task['completed']) {
                $task->project->recordActivity('task_completed');
            }
        });
    }


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return $this->project->path() . '/tasks/' . $this->id;
    }
}
