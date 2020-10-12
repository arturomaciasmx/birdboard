<?php

namespace Tests\Unit;

use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    // public function it_has_a_path()
    // {
    //     $project = Project::factory()->create();

    //     $this->assertEquals('/projects/' . $project->id, $project->path());
    // }
}
