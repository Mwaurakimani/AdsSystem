<?php

use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->prefix('/campaign/')->group(function (){

    Route::get('', [CampaignController::class,'getCampaigns']);

    Route::post('create', [CampaignController::class,'create']);

    Route::get('view/{campaign}', [CampaignController::class,'getCampaign']);

    Route::post('update/{campaign}', [CampaignController::class,'updateCampaign']);

});



