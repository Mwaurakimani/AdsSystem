<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CampaignController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->group(function (){

    Route::get('/loadBillingPage',function (){

        $user = User::find(Auth::user()->id);

        return [
            'status' => 'success',
            'bills' => $user->currentBill
        ];
    });
});



