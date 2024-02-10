<?php

namespace App\Http\Controllers\StoreAdminPanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,User};
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\ActivityResource;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\Is_Store_Owner;

class CanceledOrders extends Controller
{
    /*
        this only for STORE OWNER and no any other assitant can have access to it .    

        this class should get all cacelled orders for every time by default except if the user 
        choose by filter to get last month or week or year or day's cancelled orders .
    */

    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }
    
    
    public function cancelledOrders(Request $request)
    {
        // .. Get Start and End Date From TimeFilter Class ..
        $filter = $request->input('filter', 'all');
        $timeFrame = TimeFrameFilter::getTimeFrameDates($filter);
        $startDate = $timeFrame['start_date'];
        $endDate = $timeFrame['end_date'];

        $user = auth()->user();
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;

        // Fetch order IDs for this store with status = 0 (cancelled)
        $orderIds = Order::where('store_id', $storeId)
            ->where('status', 0)
            ->pluck('id')
            ->toArray();

        $logs = Activity::whereIn('subject_id', $orderIds)
            ->where('subject_type', [Order::class])
            ->where('description', 'Cancelled order') // Change this as per your description for canceled orders
            // Include date filtering logic if needed
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->latest()
            ->paginate(10);

        $logs->appends($request->query());

        $activityResource = ActivityResource::collection($logs);

        if(!$activityResource){
            return response()->json([
                'message'=>'Error Try Again Later !'
            ]);
        }
        return response()->json([
            'status '  => 'Success',
            'activity' => $activityResource,
        ]);

    }

}
