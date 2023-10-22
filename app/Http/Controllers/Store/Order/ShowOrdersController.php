<?php

namespace App\Http\Controllers\Store\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getStoreOrders(Request $reqeust)
    {
        $user = auth()->user();

        $storeId = DB::table('store_user')
        ->where('user_id', $user->id)
        ->select(['store_id'])
        ->first();

        $orders = Order::where('store_id', $storeId)->get();

        return response()->json([
            'orders' => $orders,
        ]);
    }
}
