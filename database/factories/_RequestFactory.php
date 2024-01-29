<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{User, Store};

class _RequestFactory extends Factory
{
    public function definition()
    {
        $store = Store::inRandomOrder()->first();
        $store_id = $store->id;
        $storeName = $store->name;
        $userId   = User::all()->random()->id;

        return [
            'store_id' => $store_id,
            'user_id'  => $userId,
            'store_name'=>$storeName,
            'response' => random_int(0, 1),
        ];
    }
}
