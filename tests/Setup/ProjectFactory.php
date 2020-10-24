<?php

namespace Tests\Setup;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class ProjectFactory
{

    protected $taskCount = 0;

    protected $owner = null;

    public function ownedBy($user)
    {

        $this->owner = $user;

        return $this;

    }

    public function withTasks($count)
    {

        $this->taskCount = $count;

        return $this;

    }

    public function create()
    {

        $project = Project::factory()->create([
            'owner_id' => function() {

                if($this->owner) {
                    return $this->owner->id;
                }

                return User::factory()->create()->id;
            }
        ]);

        Task::factory()->count($this->taskCount)->create(['project_id' => $project->id]);

        return $project;
    }

}
