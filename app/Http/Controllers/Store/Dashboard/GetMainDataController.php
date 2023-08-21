<?php

namespace App\Http\Controllers\Store\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetMainDataController extends Controller
{
    public function __construct() {
        // .. Get Best Seller Products .. 

        $totalEarn = array();

        // .. Get Top 11 Main Categories , Actually Parents Of All Products ..
        $lastWeekOrders = Order::where('store_id', $storeId)
            ->whereDate('created_at', '>=', Carbon::now()->subWeek())
            ->whereDate('created_at', '<', Carbon::now())
        ->get();
         
        $lastMonthOrders = Order::where('store_id', $storeId)
        ->whereDate('created_at', '>=', Carbon::now()->subMonth())
        ->whereDate('created_at', '<', Carbon::now())
        ->get();
         
        $lastYearOrders = Order::where('store_id', $storeId)
        ->whereDate('created_at', '>=', Carbon::now()->subYear())
        ->whereDate('created_at', '<', Carbon::now())
        ->get();

        $allStoreOrders = Order::where('store_id', $storeId)->get();

        $storeCustomers = $l;

        $lastmonthEarn =$l;

        $lastWeekEarn =$l;
        
        $lastYearEarn = $l;

    }
}
