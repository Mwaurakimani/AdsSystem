<?php

use App\Http\Controllers\FetchAdsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class,'create']);

Route::post('/login', [UserController::class,'login']);

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = Auth::user();
    return $user;
});

Route::post('/fetchAds',[FetchAdsController::class,'fetchAds']);


require_once 'API/Campaign/index.php';
require_once 'API/Pages/index.php';



