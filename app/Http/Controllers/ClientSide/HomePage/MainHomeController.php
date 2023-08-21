<?php

namespace App\Http\Controllers\ClientSide\HomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};

class MainHomeController extends Controller
{
    public function __construct() {
        // .. Get Best Seller Products .. 

        $Best_Seller= array();

        for ($i = 1; $i <= 10; $i++) {
            $Product = Product::select('name', 'price')
                ->where('category_id', $i)
                ->orderBy('sold', 'desc')
                ->take(10)
                ->get();
        
            $this->Best_Seller[$i] = $Product;
        }
        $this->categories = Category::select(['id','name','parent_id', 'image'])->whereBetween('id', [1, 10])->get();

    }

    public function getCategory(){
        if ($this->categories) {
            // .. Success Fetching ..
            return response()->json([
                'message' =>'Data Fetching Done',
                'categories'=>$this->categories ,
            ]);
        }
        // .. Failed Fetching ..
        return response()->json([
            'message'=>'Error in Fetching Categories',
        ]);
    }

    public function getProduct($id)
    {
        if ($this->categories) {
            // .. Success Fetching ..
            return response()->json([
                'status'  => 'Success',
                'message' => 'Data Fetching Done',
                'best seller products' => $this->Best_Seller[$id] ,
            ]);
        }
        // .. Failed Fetching ..
        return response()->json([
            'status' => 'Error',
            'message'=>'Error in Fetching Categories',
        ]);
    }
}
