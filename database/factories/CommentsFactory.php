<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
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
        $category_id = Category::all()->random()->id;
        return [
            'Body' => fake()->paragraph(),
            'Parent_id' => fake()->numberBetween(0,100),
            'user_id' => $user_id,
            'category_id' => $category_id,






        ];
    }
}
