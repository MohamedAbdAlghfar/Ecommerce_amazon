<?php

namespace App\Http\Controllers\Store\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResponseRequest extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function reqeustsResponseActivity(Request $request)
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

        $formattedLogs = $logs->map(function ($log) {
            // Customize the message based on the activity description
            $message = $log->description;
            $order   = $log->subject;

            $userName = $order->user;
            $orderId = $log->subject_id;

            return [
                'message' => $message,
                'order_id' => $orderId,
                'user_name' => $userName->f_name .' '. $userName->l_name,
            ];
        });

        return $formattedLogs;
    }
}
