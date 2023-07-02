<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\ShippingCompany;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class orderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_id = User::all()->random()->id;
        $shipingcom_id = ShippingCompany::all()->random()->id;
        $category_id = Category::all()->random()->id;

        return [
            'Price' => fake()->randomFloat(2, 10, 100),
            'discount' => fake()->randomElement([20,30,50]),
            'user_id' => $user_id,
            'shippingcompany' => $shipingcom_id,
            'category_id' => $category_id,
            'location' => fake()->address(),


        ];
    }
}
