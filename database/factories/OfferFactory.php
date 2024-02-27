<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $store_id    = Store::all()->random()->id;

        return [
            
            'price' => fake()->randomFloat(2, 10, 100),
            'store_id' => $store_id,
            'name' => fake()->name(),
            'about' => fake()->sentence(), 
            'custom' => fake()->randomElement([0,1]),
            'no_pieces' => fake()->numberBetween(0, 100),
            'status' => fake()->randomElement([0,1]),

        ];
    }
}
