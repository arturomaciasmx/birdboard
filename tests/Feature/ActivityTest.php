<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ActivityTest extends TestCase
{


    use RefreshDatabase;


    /** @test */
    public function creating_a_project_creates_activity()
    {
        $project = app(ProjectFactory::class)->create();

        $this->assertCount(1, $project->activity);

        $this->assertEquals('created', $project->activity[0]->description);
    }


    /** @test */
    public function updating_a_project_creates_activity()
    {

        $this->withoutExceptionHandling();
        $project = app(ProjectFactory::class)->create();

        $this->actingAs($project->owner)
            ->patch($project->path(), ['notes' => 'updated']);

        $this->assertCount(2, $project->activity);

        $this->assertEquals('updated', $project->activity->last()->description);
    }

    /** @test */
    public function creating_a_task_create_activity_on_project()
    {
        $this->withoutExceptionHandling();

        $project = app(ProjectFactory::class)->withTasks(1)->create();

        $this->assertCount(2, $project->activity);

        $this->assertEquals('task_created', $project->activity->last()->description);
        $this->assertInstanceOf(Task::class, $project->activity->last()->subject);
    }

    /** @test */
    public function completing_a_task_create_activity_on_project()
    {
        $project = app(ProjectFactory::class)->withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'body',
                'completed' => true
            ]);

        $this->assertCount(3, $project->activity);

        $this->assertEquals('task_completed', $project->activity->last()->description);

        $this->assertInstanceOf(Task::class, $project->activity->last()->subject);
    }

    /** @test */
    public function incompleting_a_task_create_activity_on_project()
    {

        $project = app(ProjectFactory::class)->withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'body',
                'completed' => true
            ]);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'body',
            'completed' => false
        ]);

        $this->assertCount(4, $project->fresh()->activity);

        $this->assertEquals('task_incompleted', $project->fresh()->activity->last()->description);
        $this->assertInstanceOf(Task::class, $project->activity->last()->subject);
    }

    /** @test */
    public function deleting_a_task_create_activity_on_project()
    {
        $project = app(ProjectFactory::class)->withTasks(1)->create();

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->activity);

        $this->assertEquals('task_deleted', $project->fresh()->activity->last()->description);
    }
}
