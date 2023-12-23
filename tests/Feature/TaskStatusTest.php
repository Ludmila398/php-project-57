<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\TaskStatus;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private TaskStatus $taskStatus;
    private string $fakeNameForTaskStatus;
    private string $fakeNameForTaskStatusUpdate;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
        $this->fakeNameForTaskStatus = TaskStatus::factory()->create();
        $this->fakeNameForTaskStatusUpdate = TaskStatus::factory()->create();
    }


    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('task_statuses.store'), [
                'name' => $this->fakeNameForTaskStatus
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $this->fakeNameForTaskStatus]);
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testStoreNotAuth(): void
    {
        $response = $this
            ->post(route('task_statuses.store'), [
                'name' => 'newTestStatus'
        ]);

        $response->assertStatus(403);
    }

    public function testEdit(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('task_statuses.edit', ['task_status' => $this->taskStatus]));

        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), [
                'name' => $this->fakeNameForTaskStatusUpdate
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $this->fakeNameForTaskStatusUpdate]);
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testUpdateNotAuth(): void
    {
        $response = $this
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), [
                'name' => 'test'
        ]);

        $response->assertStatus(403);
    }

    public function testDestroyNotAuth(): void
    {
        $response = $this
            ->delete(route('task_statuses.destroy', ['task_status' => $this->taskStatus]));

        $response->assertStatus(403);
    }

    public function testDestroy(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('task_statuses.destroy', ['task_status' => $this->taskStatus]));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', ['id' => $this->taskStatus->id]);
        $response->assertRedirect(route('task_statuses.index'));
    }
}
