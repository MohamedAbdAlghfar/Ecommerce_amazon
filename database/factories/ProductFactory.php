<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Category,Store,User};
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       
        $store_id  = Store::all()->random()->id;
        $category_id = Category::all()->random()->id;
        $userId = User::all()->random()->id;
       
       
        return [
            
            'price' => fake()->randomFloat(2, 10, 100),
            'discount' => fake()->randomElement([20,30,50]),
            'rate' => fake()->randomFloat(2, 10, 100),
            'available_pieces' => fake()->numberBetween(0, 100),
            'weight' => fake()->numberBetween(1, 30),
            'color' => fake()->randomElement(['red','blue','green','white','black']),
            'col_1' => fake()->word(),
            'col_2' => fake()->word(),  
            'col_3' => fake()->word(), 
            'col_4' => fake()->word(),
            'sold' => fake()->numberBetween(1, 30),
            'description' => fake()->paragraph(),
            'about' => fake()->paragraph(),
            'brand' => fake()->name(),
            'name' => fake()->name(),
            'store_id' => $store_id ,
            'category_id' => $category_id ,
            'added_by' => $userId ,

        ];
    }
}
