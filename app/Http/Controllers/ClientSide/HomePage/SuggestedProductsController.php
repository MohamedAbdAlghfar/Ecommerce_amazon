<?php

namespace App\Http\Controllers\ClientSide\HomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, };

class SuggestedProductsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api');
    }

    
    public function suggestedProducts(){

        $user = auth()->user();

        if (!$user) {
            $products = Product::inRandomOrder()->limit(40)->get();
            return response()->json([
                'user'=>'non authenticated user',
                'products'=>$products,
            ]);
        }

        $age = $user->age;
        $gender = $user->gender;

        if ($age >=12  && $gender == 0) {
            $fisrtCategory  = 'men';
            $secondCategory = 'pc';
            $thirdCategory  = 'moblie_phones';
            $fourthCategory = 'laptops';
        }elseif ($gender == 1 && $age >= 10) {
            $fisrtCategory  = 'women';
            $secondCategory = 'eyeliner';
            $thirdCategory  = 'dresses';
            $fourthCategory = 'makeup';
        }elseif ($gender == 0 && $age <= 10) {
            $firstCategory  = 'boys';
            $secondCategory = 'toys';
            $thirdCategory  = 'games';
            $fourthCategory = 'books';
        }elseif ($gender == 1 && $age <= 10) {
            $firstCategory  = 'girls';
            $secondCategory = 'toys';
            $thirdCategory  = 'games';
            $fourthCategory = 'books';
        }


        function getProductsByCategory($category) {
            return Product::whereHas('category', function ($query) use ($category) {
                $query->where('name', $category)->limit(10)->offset(0); })->get();
        }


        // .. Call The Function For Each Category and Merge The Results ..
        $Products = getProductsByCategory($firstCategory);
        $Products = $Products->merge(getProductsByCategory($secondCategory));
        $Products = $Products->merge(getProductsByCategory($thirdCategory));
        $Products = $Products->merge(getProductsByCategory($fourthCategory));
        $Products = $Products->toArray();

        if ($products) {
            return response()->json([
                'status' => 'Success',
                'gender' => 'men',
                'products' => $Products,
            ]);
        }
        return response()->json([
            'status' => 'Error',
            'message' => 'Error While getting the products',
        ]);


    }
}