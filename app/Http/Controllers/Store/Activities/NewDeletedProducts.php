<?php

namespace App\Http\Controllers\Store\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Product,User};
use Spatie\Activitylog\Models\Activity;

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

        // Format and return the results
        $formattedLogs = $logs->map(function ($log) {
            $message = $log->description;
            $productId = $log->subject_id;
            $product = $log->subject;

            $deletedBy = $product->deletedBy;
            $storeName = $product->store;

            return [
                'message' => $message,
                'product_id' => $productId,
                'deleted_by' => $deletedBy->f_name,
                'store_name' => $storeName->name,
            ];
        });

        // Append query parameters for pagination
        $formattedLogs->appends($request->query());

        return $formattedLogs;
    }

}
