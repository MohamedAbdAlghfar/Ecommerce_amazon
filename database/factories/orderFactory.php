<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\ShippingCompany;
use App\Models\Product;


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
        $product_id = Product::all()->random()->id;

        $start_date = '-1 year'; // Set the start date to one year ago
        $end_date = 'now'; // Set the end date to now
    
        // Generate a random date and time value between the start and end dates
        $trans_date = fake()->dateTimeBetween($start_date, $end_date);
       
       
        return [
            'price' => fake()->randomFloat(2, 10, 100), 
            'discount' => fake()->randomElement([20,30,50]), 
            'user_id' => $user_id, 
            'shipping_company_id' => $shipingcom_id,
            'product_id' => $product_id, 
            'location' => fake()->address(),
            'trans_date' => $trans_date->format('Y-m-d H:i:s'),

        ];
    }
}
