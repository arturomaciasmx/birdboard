<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_create_project()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw([]);

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function guest_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
    public function guest_cannot_view_single_project()
    {
        $project = Project::factory()->create();
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_project_require_a_title()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_require_a_description()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_project_require_a_owner()
    {
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->withoutExceptionHandling();

        $this->be(User::factory()->create());

        $project = Project::factory()->create(['owner_id' => auth()->user()->id]);

        $this->get('/projects/' . $project->id)->assertSee($project->title);
    }

    /** @test */
    public function a_user_cannot_view_projects_of_others()
    {
        $this->be(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
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
}
