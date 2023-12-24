<?php

namespace App\Http\Controllers\Store\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Product, User};
use Spatie\Activitylog\Models\Activity;

class NewAddedProducts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function productActivity(Request $request)
    {
        $startDate = null;
        $endDate = null;
        $filter = $request->input('filter', 'all');

        if ($filter === 'last_month') {

            $startDate = Carbon::now()->subMonth()->startOfMonth();
            $endDate = Carbon::now();

        } elseif ($filter === 'last_week') {

            $startDate = Carbon::now()->subWeek()->startOfWeek();
            $endDate = Carbon::now();

        } elseif ($filter === 'last_year') {

            $startDate = Carbon::now()->subYear()->startOfYear();
            $endDate = Carbon::now();

        } elseif ($filter === 'today') {

            $startDate = Carbon::today();
            $endDate = Carbon::tomorrow();
        }

        $user = auth()->user();
        $findUser = User::find($user->id);
        $storeId = $findUser->store->id;

        // Fetch order IDs for this store with status = 0 (cancelled)
        $productIds = Product::where('store_id', $storeId)
            ->pluck('id')
            ->toArray();

        $logs = Activity::whereIn('subject_id', $productIds)
            ->where('subject_type', [Product::class])
            ->where('description', 'Product created')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->latest()
            ->paginate(10);

        $logs->appends($request->query());

        $formattedLogs = $logs->map(function ($log) {
            // Retrieve the Product model instance
            $product = Product::find($log->subject_id);

            // Get the user who added the product
            $addedByUser = $product->addedBy; // Assuming you have a relationship setup
            $store  = $product->store;

            // Customize the message based on the activity description
            $message = $log->description;

            return [
                'message' => $message,
                'product_id' => $log->subject_id,
                'added_by' => $addedByUser ? $addedByUser->f_name : null, // User's name who added the product
                'store' => $store ? $store->name : null,
            ];
        });

        return $formattedLogs;
    }
}
