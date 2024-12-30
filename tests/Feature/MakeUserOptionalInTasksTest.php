<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MakeUserOptionalInTasksTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_id_can_be_null_in_tasks_table()
    {
        $task = Task::factory()->create(['user_id' => null]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'user_id' => null,
        ]);
    }

    #[Test]
    public function task_can_be_reassigned_to_different_user()
    {
        $task = Task::factory()->create(['user_id' => null]);
        $user = User::factory()->create();

        $task->user()->associate($user);
        $task->save();

        $this->assertEquals($user->id, $task->fresh()->user->id);

        $task->user()->dissociate();
        $task->save();

        $this->assertNull($task->fresh()->user->id);
    }
}
