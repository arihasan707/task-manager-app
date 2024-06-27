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
        return [
            'nama' => fake()->sentence(),
            'deskripsi' => fake()->text(),
            'user_id' => User::factory()
        ];
    }

    public function deskripsi(): static
    {
        return $this->state(fn (array $attributes) => [
            'deskripsi' => true,
        ]);
    }
}
