<?php

namespace App\Http\Controllers\StoreAdminPanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, User};
use App\Http\Resources\ActivityResource;
use Spatie\Activitylog\Models\Activity;

class RateInProduct extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Owner::class);
    }

    public function rateProductActivity(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $timeFrame = TimeFrameFilter::getTimeFrameDates($filter);
        $startDate = $timeFrame['start_date'];
        $endDate = $timeFrame['end_date'];

        
        $user = auth()->user();
        $findUser = User::find($user->id);
        $storeId = $findUser->store->id;

        $product_ids = Product::where('store_id', $storeId)
            ->pluck('id')
            ->toArray();

        $logs = Activity::whereIn('subject_id', $product_ids)
        ->where('subject_type', [Product::class])
        ->where('description', 'New Rate In Product')
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
