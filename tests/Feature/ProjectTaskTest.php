<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $project->addTask('test task');

        $this->get($project->path())->assertSee('test task');
    }

    /** @test */
    public function a_task_require_a_body()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Task::factory()->raw(['body' => '']);

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');

    }

}
