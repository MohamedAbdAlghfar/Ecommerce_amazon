<?php

namespace App\Http\Controllers\StoreAdminPanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TimeFrameFilter extends Controller
{
    public static function getTimeFrameDates($filter)
    {
        $rules = [
            'filter' => 'nullable|in:last_month,last_week,last_year,today'
        ];

        // Validate the input
        $validator = Validator::make(['filter' => $filter], $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return 'Invalid filter provided';
        }

        $startDate = null;
        $endDate = null;

        switch ($filter) 
        {
            case 'last_month':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
            break;//

            case 'last_week':
                $startDate = Carbon::now()->subWeek()->startOfWeek();
                $endDate = Carbon::now()->subWeek()->endOfWeek();
            break;//

            case 'last_year':
                $startDate = Carbon::now()->subYear()->startOfYear();
                $endDate = Carbon::now()->subYear()->endOfYear();
            break;//

            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::tomorrow();
            break;//

            default:
                $startDate = Carbon::now()->subWeek()->startOfWeek();
                $endDate = Carbon::now()->subWeek()->endOfWeek();
            break;//
        }

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
