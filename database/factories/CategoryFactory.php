<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

use Illuminate\Support\Facades\Log;

class CategoryFactory extends Factory
{

  public function definition()
  {
  
    $parent_id = Category::all()->random()->id; 

    //$parent_id = 1;      // when first migration 
          
    return [
      'name' => fake()->name(),
      'parent_id' => $parent_id, 
    ];
      
  }
}
