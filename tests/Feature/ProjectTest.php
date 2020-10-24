<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Database\Factories\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory as SetupProjectFactory;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_require_a_description()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_project_require_a_title()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_has_a_path()
    {
        $project = Project::factory()->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    /** @test */
    public function a_project_has_an_owner()
    {
        $this->withoutExceptionHandling();
        $project = Project::factory()->create();
        $this->assertInstanceOf(User::class, $project->owner);
    }

    /** @test */
    public function a_project_require_a_owner()
    {
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function a_project_can_have_tasks()
    {

        $project = app(SetupProjectFactory::class)->withTasks(1)->create();

        $this->assertCount(1, $project->tasks);

    }
}
