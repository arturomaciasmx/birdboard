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
    public function guest_cannot_add_tasks_to_projects()
    {
        $project = Project::factory()->create();

        $this->get($project->path() . '/tasks')->assertRedirect('/login');

        $task = Task::factory()->raw();

        $this->post($project->path() . '/tasks', $task)->assertRedirect('/login');
    }

    /** @test */
    public function only_the_owner_of_the_project_can_add_a_task()
    {

        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create();

        $task = Task::factory()->raw();

        $this->post($project->path() . '/tasks', $task)->assertStatus(403);

    }

    /** @test */
    public function only_the_owner_of_the_project_can_update_a_task()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create();

        $task = Task::factory()->create();

        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body' => 'updated',
            'completed' => true
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'body' => 'updated',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $project->addTask('test task');

        $this->get($project->path())->assertSee('test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $task = $project->addTask('test task');

        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body' => 'changed',
            'completed' => true
        ])->assertRedirect($project->path());

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);

    }

    /** @test */
    public function a_task_require_a_body()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Task::factory()->raw(['body' => '']);

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');

    }

    /** @test */
    public function a_task_has_path()
    {

        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $this->assertEquals($task->project->path() . '/tasks/' . $task->id, $task->path());

    }

}
