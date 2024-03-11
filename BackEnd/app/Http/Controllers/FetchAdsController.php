<?php

namespace App\Http\Controllers;

use App\Models\AdSpace;
use App\Models\Campaign;
use Illuminate\Http\Request;

class FetchAdsController extends Controller
{
    /**
     * @throws \Exception
     */
    function fetchAds(Request $request)
    {

        $data = $request->input('ad_request_setup');
        $response = [];

        if (empty($data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No data provided',
                'data' => $response
            ], 400);
        }

        foreach ($data as $add_ID) {
            $ad = AdSpace::findOrFail($add_ID);
            $page = $ad->page;
            $domain = $page->domain;

            if($ad->status == 'inactive') {
                continue;
            }

            // Parse the URL
            $url_parts = parse_url($request->headers->get('origin'));

            // Initialize the host string
            $host = '';

            // Check if scheme exists, if so, include it in the host string
            if(isset($url_parts['scheme'])) {
                $host .= $url_parts['scheme'] . '://';
            }

            // Append the host
            $host .= $url_parts['host'];

            // Check if port exists and append it to the host if it does
            if(isset($url_parts['port'])) {
                $host .= ':' . $url_parts['port'];
            }

            if ($domain != $host) {
                throw new \Exception('Invalid domain');
            }

            $relevant_ads = $this->getRelevantAds($page,$ad);

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

    public function getRelevantAds($page, $ad)
    {
        $placement = $ad->type;

        //match data type
        $campaigns = Campaign::where('display_type', $placement)->get();

        if (count($campaigns) == 0){
            return $campaigns;
        }else if (count($campaigns) ==  1){
            return $campaigns[0];
        }

        return $campaigns->random();
    }
}
