<?php

namespace Database\Factories;
use App\Models\Task;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_path' => $this->faker->file('docs', 'site', true),
            'task_id' => function () {
                return \App\Models\Task::factory()->create()->id;
            },
        ];
    }
}
