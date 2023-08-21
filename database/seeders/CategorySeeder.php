<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Insert predefined categories using Eloquent model
        Category::create(['id' => 1, 'name' => 'electronics',  'parent_id' => null]);
        Category::create(['id' => 2, 'name' => 'fashion',      'parent_id' => null]);
        Category::create(['id' => 3, 'name' => 'books',        'parent_id' => null]);
        Category::create(['id' => 4, 'name' => 'kitchen',      'parent_id' => null]);
        Category::create(['id' => 5, 'name' => 'home',         'parent_id' => null]);
        Category::create(['id' => 6, 'name' => 'sports',       'parent_id' => null]);
        Category::create(['id' => 7, 'name' => 'beauty',       'parent_id' => null]);
        Category::create(['id' => 8, 'name' => 'mobilephones', 'parent_id' => null]);
        Category::create(['id' => 9, 'name' => 'pc',           'parent_id' => null]);
        Category::create(['id' => 10,'name' => 'laptops',      'parent_id' => null]);
        Category::create(['id' => 11,'name' => 'supermarket',  'parent_id' => null]);
        // .. end of top main parent categories .. 
        // .. next all belonged to those 11 parents .. 
        Category::create(['id' => 12, 'name' => 'Laptops', 'parent_id' => 1]);
        
    }
}
