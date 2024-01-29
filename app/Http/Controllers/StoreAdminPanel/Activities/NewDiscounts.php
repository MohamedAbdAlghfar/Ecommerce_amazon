<?php

namespace App\Http\Controllers\StoreAdminPanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,User};
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\ActivityResource;

class NewDiscounts extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Owner::class);
    }

    public function newDiscountsActivity(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $timeFrame = TimeFrameFilter::getTimeFrameDates($filter);
        $startDate = $timeFrame['start_date'];
        $endDate = $timeFrame['end_date'];

        
        $user = auth()->user();
        $findUser = User::find($user->id);
        $storeId = $findUser->store->id;

        $discountedProductIds = Product::where('discount', !null)
        ->where('store_id',$storeId)
        ->pluck('id')
        ->toArray();

        $logs = Activity::whereIn('subject_id', $discountedProductIds)
            ->where('subject_type', [Product::class])
            ->where('description', 'New Discount')
            // Apply time frame filters if specified
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('deleted_at', [$startDate, $endDate]);
            })
            ->latest()
            ->paginate(10);

        $logs->load(['subject.store']);

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
