<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;
use App\Models\Comments;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comments>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        $user_id = User::all()->random()->id;
        $product_id = Product::all()->random()->id;
        return [
            'body' => fake()->paragraph(), 
            'parent_id' => null,
            'type' => fake()->numberBetween(1, 2),
            'user_id' => $user_id,
            'rate' => fake()->randomFloat(2, 10, 100),
            'product_id' => $product_id,  






        ];
    }
}
