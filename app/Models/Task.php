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

        static::deleted(function ($task) {
            $task->project->recordActivity('task_deleted');
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

    public function complete()
    {
        $this->update(['completed' => true]);
        $this->project->recordActivity('task_completed');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->project->recordActivity('task_incompleted');
    }
}
