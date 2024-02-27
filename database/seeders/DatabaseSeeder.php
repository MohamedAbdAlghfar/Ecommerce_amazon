<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Category, User, Comments, Order, Photo, ShippingCompany, Store, Cart, Product, _Request, Offer};
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $Categories = \App\Models\Category::factory(40)->create();
        $users = \App\Models\User::factory(50)->create();
       
    
        $stores = \App\Models\Store::factory(7)->create();
        \App\Models\Product::factory(200)->create();
        \App\Models\Comments::factory(150)->create();
        $shippings = \App\Models\ShippingCompany::factory(4)->create();
        $offers = \App\Models\Offer::factory(15)->create();
        $orders = \App\Models\Order::factory(200)->create();
        $requests = \App\Models\_Request::factory(200)->create();
     
       
        \App\Models\Photo::factory(50)->create();
        $carts = \App\Models\Cart::factory(50)->create();     
        foreach ($carts as $cart) {
            $product_ids = [];
            $product_ids[] = Product::all()->random()->id;
            $product_ids[] = Product::all()->random()->id;
            $product_ids[] = Product::all()->random()->id;
            $cart->Products()->sync($product_ids);
        }    


        foreach ($stores as $store) {
            $user_ids = [];
            $user_ids[] = User::all()->random()->id;
            $user_ids[] = User::all()->random()->id;
            $user_ids[] = User::all()->random()->id;
            $store->Admins()->sync($user_ids);
        }

    
        foreach ($shippings as $shipping) {
            $stores = Store::inRandomOrder()->limit(3)->get();
            
            foreach ($stores as $store) {
                $price = 10.99; // Set the desired price for the pivot table

                $shipping->stores()->attach($store, [
                    'debt' => $price,
                ]);
            }
        }


        
        foreach ($offers as $offer) {
            $product_ids = [
                'offer_id' => $offer->id,
                'product_id' => Product::all()->random()->id,
                'store_id' => $offer->store_id, // Assuming offer is associated with a store
            ];
        
            DB::table('offer_product')->insert($product_ids);
        }

        foreach ($offers as $offer) {
            $user_ids = [];
            $user_ids[] = User::all()->random()->id;
            $user_ids[] = User::all()->random()->id;
            $user_ids[] = User::all()->random()->id;
            $offer->users()->sync($user_ids);
        }




    }
}
