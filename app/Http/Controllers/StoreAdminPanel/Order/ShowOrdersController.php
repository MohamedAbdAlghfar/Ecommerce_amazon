<?php

namespace App\Http\Controllers\StoreAdminPanel\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShowOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getStoreOrders(Request $request)
    {
        $user = auth()->user();

        $storeId = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select(['store_id'])
            ->first();

        $query = Order::where('store_id', $storeId);

        // Check if time period filter is specified in the request
        if ($request->has('time_period')) {
            $timePeriod = $request->input('time_period');

            // Apply the appropriate time period filter
            switch ($timePeriod) {
                case 'last_month':
                    $query->whereBetween('created_at', [
                        Carbon::now()->subMonth()->startOfMonth(),
                        Carbon::now()->subMonth()->endOfMonth(),
                    ]);
                    break;
                case 'last_year':
                    $query->whereBetween('created_at', [
                        Carbon::now()->subYear()->startOfYear(),
                        Carbon::now()->subYear()->endOfYear(),
                    ]);
                    break;
                case 'last_week':
                    $query->whereBetween('created_at', [
                        Carbon::now()->subWeek()->startOfWeek(),
                        Carbon::now()->subWeek()->endOfWeek(),
                    ]);
                    break;
                // Add more cases for additional time period options if needed
            }
        }

        $orders = $query->orderByDesc('created_at') // Order by history (latest first)
            ->orderBy('created_at', 'DESC') // Orders of the same day come first
            ->get();

        return response()->json([
            'orders' => $orders,
        ]);
    }
}