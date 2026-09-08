<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement(['Kuliah', 'Organisasi', 'Pribadi']),
            'due_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'is_done' => false,
        ];
    }
}
