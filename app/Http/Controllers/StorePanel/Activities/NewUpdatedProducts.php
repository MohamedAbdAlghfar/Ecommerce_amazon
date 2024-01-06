<?php

namespace App\Http\Controllers\StorePanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Product, User};
use Spatie\Activitylog\Models\Activity;

class NewUpdatedProducts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function updatedProductsActivity(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $timeFrame = TimeFrameFilter::getTimeFrameDates($filter);
        $startDate = $timeFrame['start_date'];
        $endDate = $timeFrame['end_date'];

        
        $user = auth()->user();
        $findUser = User::find($user->id);
        $storeId = $findUser->store->id;

        // Fetch order IDs for this store with status = 0 (cancelled)
        $productIds = Product::where('store_id', $storeId)
            ->pluck('id')
            ->toArray();

        $logs = Activity::whereIn('subject_id', $productIds)
            ->where('subject_type', [Product::class])
            ->where('description', 'Product Updated')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->latest()
            ->paginate(10);

        $logs->appends($request->query());

        $formattedLogs = $logs->map(function ($log) {
            // Retrieve the Product model instance
            $product = Product::find($log->subject_id);

            $store  = $product->store;

            // Customize the message based on the activity description
            $message = $log->description;

            return [
                'message' => $message,
                'product_id' => $log->subject_id,
                'store' => $store ? $store->name : null,
            ];
        });

        return $formattedLogs;
    }
}
