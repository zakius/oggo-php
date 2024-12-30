<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' ' . fake()->words(2, true),
            'description' => fake()->paragraph(1),
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => fake()->optional()->dateTimeBetween('+1 month', '+2 months'),
        ];
    }

    /**
     * Indicate that the project is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'end_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }
}
