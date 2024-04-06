<?php

namespace App\Http\Controllers;

use App\Models\AdSpace;
use App\Models\Campaign;
use App\Models\CampaignsPages;
use Illuminate\Http\Request;
use App\Helpers;


class FetchAdsController extends Controller
{
    /**
     * @throws \Exception
     */
    function fetchAds(Request $request)
    {
        $data = $request->input('ad_request_setup');
        $response = [];

        if (empty($data)) return response()->json(['status' => 'error', 'message' => 'No data provided', 'data' => $response], 400);

        foreach ($data as $add_ID) {
            $ad_space = AdSpace::findOrFail($add_ID);

            if ($ad_space->status == 'inactive') continue;

            $host = $this->format_incoming_url($request);

            //check if the incoming host matches the host set
            if ($ad_space->page->domain != $host) throw new \Exception('Invalid domain');

            $relevant_ads = $this->getRelevantAds($ad_space);

            if ($relevant_ads) $this->updateStats($relevant_ads,$ad_space->page);


            $response[] = array(
                "id" => $add_ID,
                "relevant_ad" => $relevant_ads
            );
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Ads Retrieved',
            'data' => $response
        ]);
    }

    public function getRelevantAds($ad)
    {
        $placement = $ad->type;

        //match data type
        $campaigns = Campaign::where('display_type', $placement)->get();

        if (count($campaigns) == 0)  return $campaigns;
        else if (count($campaigns) == 1) return $campaigns[0];

        return $campaigns->random();
    }

    public function format_incoming_url(Request $request){
        // Initialize the host string
        $host = '';

        // Parse the incoming URL
        $url_parts = parse_url($request->headers->get('origin'));

        // Check if scheme exists, if so, include it in the host string
        if (isset($url_parts['scheme'])) $host .= $url_parts['scheme'] . '://';

        // Append the host
        $host .= $url_parts['host'];

        // Check if port exists and append it to the host if it does
        if (isset($url_parts['port'])) $host .= ':' . $url_parts['port'];

        //return the host formatted
        return $host;
    }

    private function updateStats(mixed $relevant_ads, $page)
    {
        $CampaignsPages = CampaignsPages::where('campaign_id',$relevant_ads->id)
            ->where('page_id',$page->id)->get();

        if($CampaignsPages->count() > 0){
            $CampaignsPages = $CampaignsPages->first();
            $CampaignsPages->views = $CampaignsPages->views + 1;
            $CampaignsPages->save();
        }else{
            CampaignsPages::create([
                'campaign_id' => $relevant_ads->id,
                'page_id' => $page->id
            ]);
        }

        $campaign = Campaign::find($relevant_ads->id);

        $resp = (new BillController())->updateBill($campaign,'view');


    }
}
