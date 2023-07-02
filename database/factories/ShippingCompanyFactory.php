<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingCompany>
 */
class ShippingCompanyFactory extends Factory
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
            'Website' => fake()->url(),
            'Email' => fake()->unique()->safeEmail(),
            'Address' => fake()->address(),
            'Location' => fake()->address(),
        ];
    }
}
