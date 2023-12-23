<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Label;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Label $label;
    private string $fakeNameForLabel;
    private string $fakeNameForUpdateLabel;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->label = Label::factory()->create();
        $this->fakeNameForLabel = Label::factory()->create();
        $this->fakeNameForUpdateLabel = Label::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('labels.store'), [
                'name' => $this->fakeNameForLabel
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', ['name' => $this->fakeNameForLabel]);
        $response->assertRedirect(route('labels.index'));
    }

    public function testStoreNotAuth(): void
    {
        $response = $this
            ->post(route('labels.store'), [
                'name' => 'newLabel'
        ]);

        $response->assertStatus(403);
    }

    public function testEdit(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('labels.edit', ['label' => $this->label]));

        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('labels.update', ['label' => $this->label]), [
                'name' => $this->fakeNameForUpdateLabel
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', ['name' => $this->fakeNameForUpdateLabel]);
        $response->assertRedirect(route('labels.index'));
    }

    public function testUpdateNotAuth(): void
    {
        $response = $this
            ->patch(route('labels.update', ['label' => $this->label]), [
                'name' => 'test'
        ]);

        $response->assertStatus(403);
    }

    public function testDestroyNotAuth(): void
    {
        $response = $this
            ->delete(route('labels.destroy', ['label' => $this->label]));

        $response->assertStatus(403);
    }

    public function testDestroy(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('labels.destroy', ['label' => $this->label]));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
        $response->assertRedirect(route('labels.index'));
    }
}
