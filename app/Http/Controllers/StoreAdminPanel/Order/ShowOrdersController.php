<?php

namespace App\Http\Controllers\StoreAdminPanel\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Activities\TimeFrameFilter;
use App\Http\Resources\OrderResource;

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
        if ($request->has('filter')) {
            $filter = $request->input('filter', 'all');
            $timeFrame = TimeFrameFilter::getTimeFrameDates($filter);
            $startDate = $timeFrame['start_date'];
            $endDate = $timeFrame['end_date'];
        }

        $orders = $query->orderByDesc('created_at') // Order by history (latest first)
            ->orderBy('created_at', 'DESC') // Orders of the same day come first
            ->get();

        $ordersResource = OrderResource::collection($orders);

        return response()->json([
            'status' => 'Success',
            'orders' => $ordersResource,
        ]);
    }
}