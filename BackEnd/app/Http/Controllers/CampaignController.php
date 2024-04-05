<?php

namespace App\Http\Controllers;

use App\Exports\StatsExport;
use App\Http\Requests\Campaign\CreateRequest;
use App\Models\Campaign;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers;
use Maatwebsite\Excel\Facades\Excel;
use Whoops\Exception\Formatter;


class CampaignController extends Controller
{

    public function create(CreateRequest $request)
    {
        $upload = $request->file('upload');


        $campaign = Campaign::create([
            'title' => $request->input('title'),
            'campaign_type' => $request->input('campaignType'),
            'upload' => $this->upload_image($upload),
            'display_type' => $request->input('displayType'),
            'redirect_link' => $request->input('redirectLink'),
            'display_on' => json_encode($request->input('displayOn')),
            'from_start' => $request->input('from_start'),
            'from_end' => $request->input('from_end'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Campaign created successfully',
            'campaign' => $campaign
            ]);
    }

    public function getCampaigns()
    {
        return Campaign::paginate(10);
    }

    public function getCampaign(Request $request,Campaign $campaign)
    {
        return $campaign;
    }

    public function updateCampaign(Request $request,Campaign $campaign){
        $upload = $request->file('upload');

        if($upload){
            $campaign->upload = $this->upload_image($upload);
        }

        $campaign = $campaign->update([
            'title' => $request->input('title'),
            'campaign_type' => $request->input('campaign_type'),
            'display_type' => $request->input('display_type'),
            'redirect_link' => $request->input('redirect_link'),
            'display_on' => json_encode($request->input('display_on')),
            'tags' => json_encode($request->input('tags')),
            'from_start' => $request->input('from_start'),
            'from_end' => $request->input('from_end'),
            'billing_limit' => $request->input('billing_limit'),
            'billing_limit_action' => $request->input('billing_limit_action'),
            'status' => $request->input('status'),
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Campaign updated successfully',
            'campaign' => $campaign
        ]);
    }

    private function upload_image($upload)
    {
        // Check if a file was uploaded
        if ($upload && $upload->isValid()) {
            // Define the directory within the storage folder
            $directory = 'public/ads';

            // Store the file in the specified directory
            $path = $upload->store($directory);

            // Return the relative path of the uploaded file
            return $path;
        } else {
            // File upload failed or no file was uploaded
            return null;
        }
    }

    public function getStats(Request $request,Campaign $campaign)
    {
        return response()->json([
            'success' => true,
            'stats' => $this->getStatsDataset($campaign)
        ]);
    }

    public function downloadStats(Request $request,Campaign $campaign)
    {
        return response()->json([
            'success' => true,
            'stats' => $this->getStatsDataset($campaign)
        ]);
    }

    private function getStatsDataset(Campaign $campaign): mixed
    {
        $statsDataset = $campaign->stats;

        $statsDataset->transform(function ($stat, $key) {
            $page = Pages::find($stat->page_id);

            $stat->website = $page->domain;

            $stat->status ? $stat->status = 'Active' : $stat->status = 'Inactive';

            return $stat;
        });

        return $statsDataset;
    }

    public function linkClick(Request $request){
        $parsedUrl = parse_url($request->fullPath);

        $url = $parsedUrl['scheme']."://".$parsedUrl['host'].':'.$parsedUrl['port'];
        $path = $parsedUrl['path'];

        $campaign = Campaign::find($request->id);
        $page = Pages::where('domain','LIKE',$url)->where('path','LIKE',$path)->first();

        $stat = $campaign->stats()->where('page_id',$page->id)->first();

        $stat->clicks = $stat->clicks + 1;
        $stat->save();
    }
}
