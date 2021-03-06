<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $old = [];

    public function path()
    {
        return '/projects/' . $this->id;
    }

    public function addTask($body)
    {
        return $this->tasks()->create(['body' => $body, 'completed' => false]);
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->getActivityChanges($description)
            ]);
    }

    public function getActivityChanges($description) {
        if($description === 'updated') {
            return [
                'before' => Arr::except(array_diff($this->old, $this->getAttributes()),'updated_at'),
                'after' => Arr::except(array_diff($this->getAttributes(), $this->old), 'updated_at')
            ];
        }
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
