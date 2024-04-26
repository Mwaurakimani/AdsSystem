<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use DateTime;
use Illuminate\Http\Request;
use App\Helpers;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function getStats()
    {
//        Helpers\ddh($this->getDays());
        $results = DB::table('campaigns')
            ->select(
                'campaigns.id',
                'campaigns.id',
                'p.title',
                'clicks',
                'views'
            )
            ->join('campaigns_pages as cp', 'campaigns.id', '=', 'cp.campaign_id')
            ->join('pages as p', 'cp.page_id', '=', 'p.id')
            ->whereIn('campaigns.id', [1, 2, 3])
            ->orderByDesc('clicks')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'Pages' => $results
        ]);
    }

    public function getPublisherStats()
    {
//        Helpers\ddh($this->getDays());

        $results = Campaign::select('p.title', 'p.id', 'p.domain', 'p.path', 'clicks', 'views')
            ->join('campaigns_pages as cp', 'campaigns.id', '=', 'cp.campaign_id')
            ->join('pages as p', 'cp.page_id', '=', 'p.id')
            ->orderByDesc('clicks')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'Pages' => $results
        ]);
    }

    public function getDays()
    {
        $centerDate = new DateTime();

        $week = [];

        for ($i = -3; $i <= -1; $i++) {
            $modifiedDate = clone $centerDate;
            $week[] = $modifiedDate->modify("$i days")->format('Y-m-d');
        }

        $centerDate = new DateTime();

        $week[] = $centerDate->format('Y-m-d');

        for ($i = 1; $i <= 3; $i++) {
            $modifiedDate = clone $centerDate; // Clone the DateTime object to avoid modifying the original one
            $week[] = $modifiedDate->modify("$i days")->format('Y-m-d');
        }

        return $week;
    }
}


