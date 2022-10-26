<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'task_name' => $this->faker->unique()->text(),
            'task_details' =>  $this->faker->text(),
            'created_date' => $this->faker->date(),
            'category' => $this->faker->randomElement(['critical', 'high priority', 'neutral', 'low priority']),
            'owner' => $this->faker->name()
        ];
    }
}
