<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->prefix('/pages/')->group(function (){

    Route::post('create', [PagesController::class,'create']);

    Route::get('', [PagesController::class,'getPages']);

    Route::get('view/{page}', [PagesController::class,'getPage']);

    Route::post('update/{page}', [PagesController::class,'updatePage']);

});

Route::post('/adSpace/generate',[PagesController::class,'generate']);

Route::get('/adSpace/getGenerate/{adSpace}',[PagesController::class,'getGenerate']);

Route::delete('/delete/adSpace/{adSpace}',[PagesController::class,'deleteAdSpace']);





