<?php

namespace Tests\Feature\Filament\Resources;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Livewire\Livewire;

class TaskResourceTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function it_can_create_task_without_user()
    {
        $project = Project::factory()->create();

        Livewire::test(TaskResource\Pages\CreateTask::class)
            ->set('data.project_id', $project->id)
            ->set('data.name', 'Test Task')
            ->set('data.description', 'Test Description')
            ->set('data.start_date', now())
            ->set('data.status', 'todo')
            ->call('create')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('tasks', [
            'project_id' => $project->id,
            'user_id' => null,
            'name' => 'Test Task',
        ]);
    }

    #[Test]
    public function it_can_list_tasks()
    {
        $tasks = Task::factory()->count(3)->create();

        Livewire::test(TaskResource\Pages\ListTasks::class)
            ->assertCanSeeTableRecords($tasks);
    }

    #[Test]
    public function it_can_edit_task()
    {
        $task = Task::factory()->create();
        $newUser = User::factory()->create();

        Livewire::test(TaskResource\Pages\EditTask::class, [
            'record' => $task->id,
        ])
            ->set('data.project_id', $task->project_id)
            ->set('data.user_id', $newUser->id)
            ->set('data.name', 'Updated Task')
            ->set('data.description', $task->description)
            ->set('data.start_date', $task->start_date)
            ->set('data.status', 'in_progress')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'user_id' => $newUser->id,
            'name' => 'Updated Task',
            'status' => 'in_progress',
        ]);
    }
}
