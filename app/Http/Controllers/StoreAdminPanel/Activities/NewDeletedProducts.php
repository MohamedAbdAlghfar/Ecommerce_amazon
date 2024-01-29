<?php

namespace App\Http\Controllers\StoreAdminPanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,User};
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\ActivityResource;

class NewDeletedProducts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function deletedProductsActivity(Request $request)
    {
        $$filter = $request->input('filter', 'all');
        $timeFrame = TimeFrameFilter::getTimeFrameDates($filter);
        $startDate = $timeFrame['start_date'];
        $endDate = $timeFrame['end_date'];

        
        $user = auth()->user();
        $findUser = User::find($user->id);
        $storeId = $findUser->store->id;

        // Retrieve deleted product IDs
        $deletedProductIds = Product::where('deleted_at', !null)
        ->where('store_id',$storeId)
        ->pluck('id')
        ->toArray();

        // Filter activity logs based on deleted product IDs
        $logs = Activity::whereIn('subject_id', $deletedProductIds)
            ->where('subject_type', [Product::class])
            ->where('description', 'Deleted Product')
            // Apply time frame filters if specified
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('deleted_at', [$startDate, $endDate]);
            })
            ->latest()
            ->paginate(10);

        // Eager load related models to prevent N+1 queries
        $logs->load(['subject.deletedBy', 'subject.store']);

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
