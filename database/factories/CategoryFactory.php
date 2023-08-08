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
    
              $parent_id = Category::all()->random()->id; 

     // $parent_id = 1;      // when first migration 
    
      
      
       
       
        return [
           // 'price' => fake()->randomFloat(2, 10, 100),
           // 'discount' => fake()->randomElement([20,30,50]),
           // 'available_pieces' => fake()->numberBetween(0, 100),
           // 'weight' => fake()->numberBetween(1, 30),
           // 'color' => fake()->randomElement(['red','blue','green','white','black']),
           // 'col_1' => fake()->word(),
           // 'col_2' => fake()->word(),  
           // 'col_3' => fake()->word(),
           // 'col_4' => fake()->word(),
           // 'buy' => fake()->numberBetween(1, 30),
           // 'description' => fake()->paragraph(),
           // 'about' => fake()->paragraph(),
           // 'brand' => fake()->name(),
         //   'Ordering' => $ordering,
            'name' => fake()->name(),
            'parent_id' => $parent_id,
            'image'     => fake()->randomElement([
                'https://m.media-amazon.com/images/I/61iQu0VHEWL._AC_UL480_FMwebp_QL65_.jpg',
                'https://m.media-amazon.com/images/I/61xW8gDKGGL._AC_UL480_FMwebp_QL65_.jpg',
                'https://m.media-amazon.com/images/I/71JouV4uIVL._AC_UL480_FMwebp_QL65_.jpg',
                'https://images-eu.ssl-images-amazon.com/images/G/42/Egypt-hq/2022/img/Consumer_Electronics/PC/1483263_EG_PCRevamp_L2_Desktop-03.jpg',
                'https://m.media-amazon.com/images/I/61LjHM2KxfL._AC_UL480_QL65_.jpg',
                'https://m.media-amazon.com/images/I/61Gp0PLpnTL._AC_UL480_QL65_.jpg',
                'https://images-eu.ssl-images-amazon.com/images/G/02/AISExports_UK_GW/Desktop/AIS_GW_DESKTOP_CATCARD_BOOKS_378x304._SY304_CB642486522_.jpg',
                'https://m.media-amazon.com/images/I/410pPI-1NRL._SY500__AC_SY230_.jpg',
                'https://m.media-amazon.com/images/I/4165BwTcQzL._AC._SR360,460.jpg',
                'https://m.media-amazon.com/images/I/71tduSp8ooL._AC._SR360,460.jpg']),



        ];
    }
}
