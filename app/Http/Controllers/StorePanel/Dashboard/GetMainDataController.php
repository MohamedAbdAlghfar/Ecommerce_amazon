<?php

namespace App\Http\Controllers\StorePanel\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Order, User};
use Illuminate\Support\Facades\DB;

class GetMainDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function mainData() {

        $user = auth()->user();
        $userId = $user->id;
        $storeId = DB::table('store_user')->where('user_id', $userId)->select(['store_id'])->first();

        $totalEarn = Order::where('store_id', $storeId)
        ->where('status', '!=',0)
        ->sum('price');

        // .. select last week orders for this store ..
        $lastWeekOrders = Order::where('store_id', $storeId)
        ->where('status', '!=',0)
        ->whereDate('created_at', '>=', Carbon::now()->subWeek())
        ->whereDate('created_at', '<', Carbon::now())
        ->paginate(10);
        $lastWeekOrders->appends(request()->query());
    
        // .. select last month orders for this store ..
        $lastMonthOrders = Order::where('store_id', $storeId)
        ->where('status', '!=', 0)
        ->whereDate('created_at', '>=', Carbon::now()->subMonth())
        ->whereDate('created_at', '<', Carbon::now())
        ->paginate(10);
        $lastMonthOrders->appends(request()->query());

        // .. select last year orders for this store ..
        $lastYearOrders = Order::where('store_id', $storeId)
        ->where('status', '!=', 0)
        ->whereDate('created_at', '>=', Carbon::now()->subYear())
        ->whereDate('created_at', '<', Carbon::now())
        ->paginate(10);
        $lastYearOrders->appends(request()->query());

        // .. select all orders for this store ..
        $allStoreOrders = Order::where('store_id', $storeId)
        ->where('status', '!=', 0)
        ->paginate(10);
        $allStoreOrders->appends(request()->query());

        // .. this part should select all customers of this store and show their data to the store owner ..
        $storeCustomersIds = DB::table('store_user')->where('store_id', $storeId)->select('id')->pluck();
        $storeCustomersData = User::whereIn('id', $storeCustomersIds)
        ->where('status', '!=', 0)
        ->where('role', 0)
        ->select(['f_name','email','phone'])
        ->paginate(10);
        $storeCustomersData->appends(request()->query());



        // .. Last Month Earn Total ..

        $startDate0 = Carbon::now()->startOfMonth();
        $endDate0 = Carbon::now()->endOfMonth();

        $lastMonthEarn = Order::whereBetween('created_at', [$startDate0, $endDate0])
            ->where('status', '!=', 0)
            ->where('store_id', $storeId)
            ->sum('price'); 



        // .. Last Week Earn Total ..

        $startDate1 = Carbon::now()->subWeek()->startOfWeek();
        $endDate1 = Carbon::now()->subWeek()->endOfWeek();

        $lastWeekEarn = Order::whereBetween('created_at', [$startDate1, $endDate1])
            ->where('status', '!=', 0)
            ->where('store_id', $storeId)
            ->sum('price'); 


        // .. Last Year Earn Total ..

        $startDate2 = Carbon::now()->subYear()->startOfYear();
        $endDate2 = Carbon::now()->subYear()->endOfYear();

        $lastYearEarn = Order::whereBetween('created_at', [$startDate2, $endDate2])
            ->where('status', '!=', 0)
            ->where('store_id', $storeId)
            ->sum('price');


        // END .. return results ..
        return response()->json([
            'all store orders' => $allStoreOrders,
            'last week orders' => $lastWeekOrders,
            'last month orders'=> $lastMonthOrders,
            'last year orders' => $lastYearOrders,
            'last month earn'  => $lastMonthEarn,
            'last year earn'   => $lastYearEarn,
            'last week earn'   => $lastWeekEarn,
            'store customers'  => $storeCustomersData,
            'total sotre earn' => $totalEarn,
        ]);
    }
}
