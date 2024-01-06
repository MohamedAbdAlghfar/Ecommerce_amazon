<?php

namespace App\Http\Controllers\StorePanel\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

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

        $storeCustomersIds = DB::table('store_user')->where('store_id', $storeId)->select('id')->pluck();
        $selectedCustomers = User::whereIn('id', $storeCustomersIds)
        ->where('role', 0)
        ->select(['f_name','email','phone'])
        ->get();

        // .. Last Month Earn Total ..

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Calculate the sum of prices for orders created this month
        $lastMonthEarn = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('store_id', $storeId)
            ->sum('price'); // Assuming 'price' is the column name holding order prices

        return $lastMonthEarn;


        // .. Last Week Earn Total ..

        $startDate = Carbon::now()->subWeek()->startOfWeek();
        $endDate = Carbon::now()->subWeek()->endOfWeek();

        // Calculate the sum of prices for orders created this month
        $lastWeekEarn = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('store_id', $storeId)
            ->sum('price'); // Assuming 'price' is the column name holding order prices

        return $lastWeekEarn;


        // .. Last Year Earn Total ..

        $startDate = Carbon::now()->subYear()->startOfYear();
        $endDate = Carbon::now()->subYear()->endOfYear();

        // Calculate the sum of prices for orders created this month
        $lastYearEarn = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('store_id', $storeId)
            ->sum('price'); // Assuming 'price' is the column name holding order prices

        return $lastYearEarn;

    }
}
