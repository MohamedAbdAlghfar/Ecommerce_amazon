<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

use Illuminate\Support\Facades\Log;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       $ordering = rand(0, 5);
       if($ordering != 0)
       $parent_id = Category::where('Ordering',$ordering - 1 )->get()->random()->id;
       else
       $parent_id = Category::where('Ordering',0 )->get()->random()->id;
     // $parent_id = 1;  
    
      
      
       
       
        return [
            'Price' => fake()->randomFloat(2, 10, 100),
            'Discount' => fake()->randomElement([20,30,50]),
            'Available_Bices' => fake()->numberBetween(0, 100),
            'Weight' => fake()->numberBetween(1, 30),
            'Color' => fake()->randomElement(['red','blue','green','white','black']),
            'Col_1' => fake()->word(),
            'Col_2' => fake()->word(),
            'Col_3' => fake()->word(),
            'Col_4' => fake()->word(),
            'Buy' => fake()->numberBetween(1, 30),
            'Description' => fake()->paragraph(),
            'About' => fake()->paragraph(),
            'Name' => fake()->name(),
            'Brand' => fake()->name(),
            'Ordering' => $ordering,
          
            'Parent_id' => $parent_id,






        ];
    }
}
