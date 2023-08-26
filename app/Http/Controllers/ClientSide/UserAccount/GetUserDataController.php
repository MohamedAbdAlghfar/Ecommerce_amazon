<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,Store,User,Cart,Product};

class GetUserDataController extends Controller
{
    // .. this class have 4 functions , all of those return some of user's data 
    // .. all is [togetorders],[togetuser's store],[to-get-personaldata],[products-in-cart]

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUserOrders(){ // .. all user orders ..
 
        $user = auth()->user();

        $userId = $user->id;

        $userOrders = Order::where('user_id', $userId)->get();
        $count = Order::where('user_id', $userId)->count();

        if (!$userOrders) {
            return response()->json([
                'staus'=>'failed',
                'message'=>'Error While Getting Orders ! Try Again Later',
            ]);
        }
        return response()->json([
            'staus'=>'Success',
            'orders'=>$userOrders,
            'ordercount'=>$count,
        ]);
    }

    public function getUserStore(){
        $user = auth()->user();

        $userId = $user->id;

        $userStore = Store::where('user_id', $userId)->select('name','Store_image')->get();

        if (!$userStore) {
            return response()->json([
                'message'=>'User Doesent Have Any Store .',
            ]);
        }
        return response()->json([$userStore]);
    }

    public function getPersonalData(){

        $user = auth()->user();
        
        $userId = $user->id;

        $userPersonalData = User::find($userId)->only('f_name','l_name','email','age','gender','address','phone');

        if (!$userPersonalData) {
            return response()->json(['status'=>'Failed']);
        }
        return response()->json([$userPersonalData]);
    }

    public function getAllCartProducts(){

        $user = auth()->user();
        $cartId = $user->cart->id;

        $ids = CartProduct::whereIn('cart_id')->select(['product_id'])->get();
        $products = Product::whereIn('id', $ids)->get();

        if($products){
            return response()->json([$products]);
        }
        // .. If Any Error Happen With Getting Data ..
        return response()->json(['message' =>'Failed To Get The Data !']);
    }
}
