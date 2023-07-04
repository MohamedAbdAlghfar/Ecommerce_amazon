<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Comments;
use App\Models\order;
use App\Models\Photo;
use App\Models\ShippingCompany;
use App\Models\Store;
use App\Models\Cart;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $Categories = \App\Models\Category::factory(100)->create();
       $users = \App\Models\User::factory(20)->create();
       foreach ($users as $user) {
        $category_ids = [];
        $category_ids[] = Category::all()->random()->id;
        $category_ids[] = Category::all()->random()->id;
        $category_ids[] = Category::all()->random()->id;
    $user->Categories()->sync($category_ids);
    
    }
       
       \App\Models\Comments::factory(150)->create();
        \App\Models\ShippingCompany::factory(4)->create();
        \App\Models\order::factory(200)->create();
       $stores = \App\Models\Store::factory(7)->create();
     
       foreach ($stores as $store) {
        $category_ids = [];
        $category_ids[] = Category::all()->random()->id;
        $category_ids[] = Category::all()->random()->id;
        $category_ids[] = Category::all()->random()->id;
    $store->Categories()->sync($category_ids);
    
    }
     
     
    foreach ($stores as $store) {
        $user_ids = [];
        $user_ids[] = User::all()->random()->id;
        $user_ids[] = User::all()->random()->id;
        $user_ids[] = User::all()->random()->id;
    $store->Users()->sync($user_ids);
    
    }
    
    
    \App\Models\Photo::factory(131)->create();
    $carts = \App\Models\Cart::factory(20)->create();     
    foreach ($carts as $cart) {
        $category_ids = [];
        $category_ids[] = Category::all()->random()->id;
        $category_ids[] = Category::all()->random()->id;
        $category_ids[] = Category::all()->random()->id;
    $cart->Categories()->sync($category_ids);
    
    }     






    }}
