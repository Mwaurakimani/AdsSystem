<?php

namespace App\Http\Controllers;

use App\Models\AdSpace;
use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getPages(Request $request)
    {
        return Pages::paginate(15);
    }

    public function create(Request $request)
    {
        $page = Pages::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Pages updated successfully',
            'campaign' => $page
        ]);
    }
    public function getPage(Request $request,Pages $page)
    {
        $page->load('adSpaces');
        return $page;
    }

    public function updatePage(Request $request,Pages $page)
    {
        $page->update($request->only(['title','domain','path','status','tags']));
        $page->tags = json_encode($request->input('tags'));
        $page->save();

        return response()->json([
            'success' => true,
            'message' => 'Pages updated successfully',
            'pages' => $page
        ]);
    }

    public function generate(Request $request)
    {
        $adSpace = AdSpace::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'adSpace created successfully',
            'adSpace' => $adSpace
        ]);
    }

    public function getGenerate(Request $request,AdSpace $adSpace)
    {
        return $adSpace;
    }

    public function deleteAdSpace(Request $request, AdSpace $adSpace)
    {
        $adSpace->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ad Space deleted successfully',
            'adSpace' => $adSpace
        ]);
    }
}
