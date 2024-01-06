<?php

namespace App\Http\Controllers\StorePanel\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersDataControllr extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // .. Get All Customers Of Store ..
    public function showAllCustomers(Request $request)
    {
        $user = auth()->user();

        // .. by this way coz any time user buy anything from this->store he be one of store clients ..
        $storeId = DB::table('store_user')
        ->where('user_id', $user->id)
        ->select(['store_id'])
        ->first();

        $storeUsers = DB::table('store_user')
        ->where('store_id', $storeId)
        ->select('id')
        ->first();

        $storeCustomers = User::whereIn('id', $storeUsers)
        ->where('role', 0)
        ->selectRow('id', 'f_name', 'email', 'phone', 'address')
        ->get();

        return response()->json([
            'customers' => $storeCustomers,
        ]);
    }
}
