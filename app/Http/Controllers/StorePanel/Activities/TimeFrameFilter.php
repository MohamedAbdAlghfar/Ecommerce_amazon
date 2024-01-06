<?php

namespace App\Http\Controllers\StorePanel\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeFrameFilter extends Controller
{
    public static function getTimeFrameDates($filter)
    {
        $startDate = null;
        $endDate = null;

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
                // Handle 'all' or unknown cases if needed
                break;
        }

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
