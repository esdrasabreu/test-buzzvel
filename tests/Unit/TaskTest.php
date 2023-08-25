<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Carbon\Carbon;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_user_auth_can_list_tasks(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/tasks');
        $response->assertStatus(200);
    }

    public function test_user_auth_can_create_task(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/tasks', [
            'title' => 'title task',
            'description' => 'description test',
            'status' => 'pending',
            'created_at' => Carbon::now(),
            'user_id' => $user->id
        ]);
        $response->assertStatus(201)
        ->assertJsonFragment([
            'title' => 'title task',
            'description' => 'description test',
            'status' => 'pending',
            'created_at' => $response->json('created_at'),
            'completed_at' => null,
            'user_id' => $user->id,
            'id' => $response->json('id')
        ]);

    }
    public function test_user_auth_can_update_task(){
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->actingAs($user)->putJson('/api/tasks/'.$task->id, [
            'title' => 'title task',
            'description' => 'description test',
            'status' => 'pending',
            'updated_at' => Carbon::now(),
            'completed_at' => null,
            'user_id' => $user->id
        ]);
        $response->assertStatus(200)
        ->assertJsonFragment([
            'title' => 'title task',
            'description' => 'description test',
            'status' => 'pending',
            'created_at' => $response->json('created_at'),
            'updated_at' => $response->json('updated_at'),
            'deleted_at' => null,
            'completed_at' => null,
            'user_id' => $user->id,
            'id' => $response->json('id')
        ]);
    }
    public function test_user_auth_can_delete_task(){
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->actingAs($user)->deleteJson('/api/tasks/'.$task->id); 
        $response->assertStatus(200)
                ->assertJsonFragment([
                    'message' =>'Task with ID '.$task->id.' has been successfully deleted.'
                ]);
    }
    public function test_user_auth_can_get_task(){
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->actingAs($user)->getJson('/api/tasks/'.$task->id);
        $response->assertStatus(200)
         ->assertJsonFragment([
             'title' => $response->json('title'),
             'description' => $response->json('description'),
             'status' => $response->json('status'),
             'created_at' => $response->json('created_at'),
             'updated_at' => $response->json('updated_at'),
             'deleted_at' => null,
             'completed_at' => $response->json('completed_at'),
             'user_id' => $user->id,
             'id' => $response->json('id')
         ]);
    }
}
