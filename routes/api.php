<?php

use App\Http\Controllers\Api\ReportsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'reports', 'namespace' => 'Api'], function(){
    Route::get('months', [ReportsApiController::class, 'months']);
});
