<?php

namespace App\Http\Controllers\homepagecontrollers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\homepagecontrollers\mainhomecontroller;
use App\Http\Controllers\homepagecontrollers\Bestsellercontroller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class mainhomecontroller extends Controller
{
    public function __construct() {
        // .. Get Best Seller Products ..

        $Best_Seller= array();

        for ($i = 1; $i <= 10; $i++) {
            $Product = Product::select('name', 'price')
                ->where('category_id', $i)
                ->orderBy('Buy', 'desc')
                ->take(10)
                ->get();
        
            $this->Best_Seller[$i] = $Product;
        }
        $this->categories = Category::select('id','name','parent_id', 'image')->whereBetween('id', [1, 10])->get();

    }

    public function getCategory(){
        return response()->json($this->categories);
    }

    public function getProduct($id)
    {
        return response()->json($this->Best_Seller[$id]);
    }
}
