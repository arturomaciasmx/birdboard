<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ManageProjectTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_manage_project()
    {

        $project = Project::factory()->create();

        $this->get('/projects')->assertRedirect('login');

        $this->get('/projects/create')->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');

        $this->post('/projects', $project->toArray())->assertRedirect('/login');

    }

    /** @test */
    public function a_user_can_crate_a_project() {

        $this->be(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

        $attributes = Project::factory()->raw(['owner_id' => auth()->user()->id]);

        $this->post('/projects', $attributes)->assertRedirect('/projects');
    }

    /** @test */
    public function a_user_can_update_a_project() {

        $project = Project::factory()->create();

        $this->actingAs($project->owner);

        $this->patch($project->path(), $attributes = ['notes' => 'updated']);

        $this->assertDatabaseHas('projects', $attributes);

    }

    /** @test */
    public function a_user_can_view_their_project()
    {

        $project = app(ProjectFactory::class)->create();

        $this->actingAs($project->owner)
            ->get($project->path())->assertSee($project->title);

    }

    /** @test */
    public function a_user_cannot_view_projects_of_others()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_user_cannot_update_projects_of_others()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()->create();

        $this->patch($project->path(), ['notes' => 'test update'])->assertStatus(403);
    }

}
