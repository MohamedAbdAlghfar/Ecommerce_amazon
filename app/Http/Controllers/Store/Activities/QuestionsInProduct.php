<?php

namespace App\Http\Controllers\Store\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Comments, User, Product};
use Spatie\Activitylog\Models\Activity;

class QuestionsInProduct extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function newQuestionInProductActivity(Request $request)
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

        $product_ids = Product::where('store_id', $storeId)
            ->pluck('id')
            ->toArray();
        // Fetch order IDs for this store with status = 0 (cancelled)
        $commentsIds = Comments::whereIn('product_id', $product_ids)
            ->pluck('id')
            ->toArray();

        $logs = Activity::whereIn('subject_id', $commentsIds)
            ->where('subject_type', [Comments::class])
            ->where('description', 'New Question In Product')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->latest()
            ->paginate(10);

        $logs->appends($request->query());

        $formattedLogs = $logs->map(function ($log) {
            // Retrieve the Product model instance
            $comment = Comments::find($log->subject_id);

            $productId = $comment->product_id;

            $store  = $product->store;

            // Customize the message based on the activity description
            $message = $log->description;

            return [
                'message' => $message,
                'product_id' => $productId,
                'store' => $store ? $store->name : null,
            ];
        });

        return $formattedLogs;
    }
}
