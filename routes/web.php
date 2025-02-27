<?php

use App\Http\Controllers\Api\V1\BestsellersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('/bestsellers', [BestsellersController::class, 'index']);
    });
});
