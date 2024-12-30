<?php

namespace Tests\Unit\Models;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_belongs_to_a_project()
    {
        $task = Task::factory()->create();
        $this->assertInstanceOf(Project::class, $task->project);
    }

    #[Test]
    public function it_can_have_an_optional_user()
    {
        $task = Task::factory()->create(['user_id' => null]);
        $this->assertNull($task->user->id);

        $user = User::factory()->create();
        $task->user()->associate($user);
        $task->save();

        $this->assertEquals($user->id, $task->fresh()->user->id);
    }

    #[Test]
    public function it_has_correct_status_options()
    {
        $task = Task::factory()->create(['status' => 'todo']);
        $this->assertEquals('todo', $task->status);

        $task->status = 'in_progress';
        $task->save();
        $this->assertEquals('in_progress', $task->fresh()->status);

        $task->status = 'done';
        $task->save();
        $this->assertEquals('done', $task->fresh()->status);
    }
}
