<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\ShippingCompany;
use App\Models\Product;
use Illuminate\Support\Arr;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
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
        $offerId = fake()->numberBetween(1, 400);
        $product = Product::inRandomOrder()->first();
        $productDiscount = $product->discount;
        $productPrice    = $product->price;
        $productActualPrice = $productPrice - ($productDiscount/100) * $productPrice;
        $product_id = $product->id;
        $storeId = $product->store_id;

        $start_date = '-1 year';
        $end_date = 'now';

        $trans_date = fake()->dateTimeBetween($start_date, $end_date);
        $cancellationRandom = fake()->dateTimeBetween($start_date, $end_date);

        $options = [$cancellationRandom, $cancellationRandom, null];
        $cancellationDate = Arr::random($options);

        $realCancellation = null; // Default value

        if ($cancellationDate !== null) {
            $realCancellation = $cancellationDate->format('Y-m-d H:i:s');
        }

        return [
            'price' => $productActualPrice,
            'user_id' => $user_id,
            'store_id' => $storeId,
            'status' => fake()->randomElement([1,2,3]),
            'shipping_company_id' => $shipingcom_id,
            'product_id' => $product_id,
            'offer_id' => $offerId,
            'location' => fake()->address(),
            'trans_date' => $trans_date->format('Y-m-d H:i:s'),

            'cancellation_date'=> $realCancellation,

        ];
    }
}
