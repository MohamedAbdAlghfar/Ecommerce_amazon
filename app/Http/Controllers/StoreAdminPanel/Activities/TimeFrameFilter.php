<?php

namespace App\Http\Controllers\StoreAdminPanel\Activities;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TimeFrameFilter
{
    public static function getTimeFrameDates($filter)
    {
        $rules = [
            'filter' => 'nullable|in:last_month,last_week,last_year,today'
        ];

        // Create a validator instance
        $validator = Validator::make(['filter' => $filter], $rules);

        // Check if validation fails
        if ($validator->fails()) {
            // Handle validation error (if needed)
            // For simplicity, let's return a default time frame
            return self::getDefaultTimeFrame();
        }

        // Set the dates based on the filter
        switch ($filter) {
            case 'last_month':
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'last_week':
                $startDate = Carbon::now()->subWeek()->startOfWeek();
                $endDate = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'last_year':
                $startDate = Carbon::now()->subYear()->startOfYear();
                $endDate = Carbon::now()->subYear()->endOfYear();
                break;
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::tomorrow();
                break;
            default:
                return self::getDefaultTimeFrame();
        }

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }

    private static function getDefaultTimeFrame()
    {
        // Return a default time frame (e.g., last week) if validation fails
        $startDate = Carbon::now()->subWeek()->startOfWeek();
        $endDate = Carbon::now()->subWeek()->endOfWeek();
        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
