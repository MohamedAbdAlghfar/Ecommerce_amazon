<?php

namespace App\Http\Controllers\StoreAdminPanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Modles\{_Request, User};
use App\Http\Resources\ActivityResource;

class ResponseRequest extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Owner::class);
    }

    public function reqeustsResponseActivity(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $timeFrame = TimeFrameFilter::getTimeFrameDates($filter);
        $startDate = $timeFrame['start_date'];
        $endDate = $timeFrame['end_date'];

        
        $user = auth()->user();
        $findUser = User::find($user->id);
        $storeId = $findUser->store->id;

        // .. select all order ids for this store ..
        $requestsIds = _Request::where('store_id', $storeId)->pluck('id')->toArray();
        
        $logs = Activity::whereIn('subject_id', $requestsIds)
        ->where('subject_type', [_Request::class])
        ->where('description', 'New Request Response')
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
