<?php

namespace App\Http\Controllers\ClientSide\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class GetUserOrders extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUserOrders(){ // .. all user orders ..
 
        $user = auth()->user();

        $userId = $user->id;

        $userOrders = Order::where('user_id', $userId)->get();// && make that query with findOrFail &&

        if (!$userOrders) {
            return response()->json([
                'staus'=>'failed',
                'message'=>'Error While Getting Orders ! Try Again Later',
            ]);
        }
        return response()->json([
            'staus'=>'Success',
            'orders'=>$userOrders,
        ]);
    }
}
