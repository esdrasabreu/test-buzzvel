<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id'); // Pega todos os IDs dos usuários cadastrados
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'created_at' => $this->faker->dateTime(),
            'completed_at' => $this->faker->dateTime(),
            // 'updated_at' => $this->faker->dateTime(),
            'user_id' => $this->faker->randomElement($userIds),
            //
        ];
    }
}
