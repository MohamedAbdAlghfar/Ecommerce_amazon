<?php

namespace App\Http\Controllers\Store\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Product,User};
use Spatie\Activitylog\Models\Activity;

class NewDiscounts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function newDiscountsActivity(Request $request)
    {
        $startDate = null;
        $endDate = null;
        $filter = $request->input('filter', 'all');

        if ($filter === 'last_month') {

            $startDate = Carbon::now()->subMonth()->startOfMonth();
            $endDate = Carbon::now()->subMonth()->endOfMonth();

        } elseif ($filter === 'last_week') {

            $startDate = Carbon::now()->subWeek()->startOfWeek();
            $endDate = Carbon::now()->subWeek()->endOfWeek();

        } elseif ($filter === 'last_year') {

            $startDate = Carbon::now()->subYear()->startOfYear();
            $endDate = Carbon::now()->subYear()->endOfYear();

        } elseif ($filter === 'today') {

            $startDate = Carbon::today();
            $endDate = Carbon::tomorrow();
        }

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

        // Format and return the results
        $formattedLogs = $logs->map(function ($log) {
            $message = $log->description;
            $productId = $log->subject_id;
            $product = $log->subject;

            $storeName = $product->store;

            return [
                'message' => $message,
                'product_id' => $productId,
                'store_name' => $storeName->name,
            ];
        });

        // Append query parameters for pagination
        $formattedLogs->appends($request->query());

        return $formattedLogs;
    }
}
