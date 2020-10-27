<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        return '/projects/' . $this->id;
    }

    public function addTask($body)
    {
        return $this->tasks()->create(['body' => $body, 'completed' => false]);
    }

    public function recordActivity($type)
    {
        $this->activity()->create([
            'project_id' => $this->id,
            'description' => $type
        ]);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
