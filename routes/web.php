<?php

use App\Http\Controllers\Api\V1\BestsellersController;
use App\Http\Middleware\EnsureJson;
use Illuminate\Support\Facades\Route;

Route::prefix('api')
    ->middleware(EnsureJson::class)
    ->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('/bestsellers', [BestsellersController::class, 'index']);
    });
});
