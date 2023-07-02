<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Name' => fake()->name(),
            'Phone' => fake()->PhoneNumber(),
            'About' => fake()->paragraph(),
            'Website' => fake()->url(),
            'services' => fake()->paragraph(),
            'Location' => fake()->address(),
            'Email' => fake()->unique()->safeEmail(),



        ];
    }
}
