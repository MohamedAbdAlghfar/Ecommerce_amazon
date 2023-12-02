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

        $categoryIds = [];

        if ($age >= 12 && $gender == 0) {
            $categoryIds = [
            1,
            2, 
            3, 
            4 ];
        } elseif ($gender == 1 && $age >= 10) {
            $categoryIds = [
            5, 
            6, 
            7, 
            8 ];
        } elseif ($gender == 0 && $age <= 10) {
            $categoryIds = [
            9, 
            10, 
            11, 
            12 ];
        } elseif ($gender == 1 && $age <= 10) {
            $categoryIds = [
            13, 
            14, 
            15, 
            16 ];
        }

        $products = Product::whereIn('category_id', $categoryIds)
            ->limit(10)
            ->offset(0)
            ->get();

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