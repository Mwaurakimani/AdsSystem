<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;

Route::post('/clickResponse', [CampaignController::class,'linkClick']);


Route::middleware(['auth:sanctum'])->prefix('/campaign/')->group(function (){

    Route::get('', [CampaignController::class,'getCampaigns']);

    Route::post('create', [CampaignController::class,'create']);

    Route::get('view/{campaign}', [CampaignController::class,'getCampaign']);

    Route::post('update/{campaign}', [CampaignController::class,'updateCampaign']);

    Route::post('/getCampaignStats/{campaign}', [CampaignController::class,'getStats']);

    Route::post('/downloadStats/{campaign}', [CampaignController::class,'downloadStats']);


    Route::post('/getMarketerStats', [AnalyticsController::class,'getStats']);

    Route::post('/getPublisherStats', [AnalyticsController::class,'getPublisherStats']);


});



