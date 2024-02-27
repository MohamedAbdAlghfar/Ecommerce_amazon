<?php

namespace App\Http\Controllers\StoreAdminPanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order, User};
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\ActivityResource;
use App\Http\Middleware\Is_Store_Owner;
use Illuminate\Support\Facades\DB;

class NewOrders extends Controller
{
    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }
    
    public function orderActivity(){

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

        // .. select all order ids for this store ..
        $orderIds = Order::where('store_id', $storeId)->pluck('id')->toArray();
        
        $logs = Activity::whereIn('subject_id', $orderIds)

        ->where('subject_type', [Order::class])
        ->where('description', 'New order created')

        // .. when there are selected date ..
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->latest()
        ->paginate(10);

        $logs->load(['subject.user']);

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
