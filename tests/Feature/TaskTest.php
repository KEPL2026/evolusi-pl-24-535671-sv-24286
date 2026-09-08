<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_list_page_loads(): void
    {
        Task::factory()->count(3)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
    }

    public function test_user_can_create_task(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => 'Kerjakan tugas Rekayasa Perangkat Lunak',
            'category' => 'Kuliah',
            'due_date' => now()->addDays(3)->format('Y-m-d'),
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'title' => 'Kerjakan tugas Rekayasa Perangkat Lunak',
        ]);
    }

    public function test_user_can_toggle_task_completion(): void
    {
        $task = Task::factory()->create(['is_done' => false]);

        $this->patch(route('tasks.toggle', $task));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_done' => true,
        ]);
    }

    public function test_user_can_delete_task(): void
    {
        $task = Task::factory()->create();

        $this->delete(route('tasks.destroy', $task));

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
