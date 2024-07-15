<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PlayerIdController;

Route::post('/save-subscription-id', [SubscriptionController::class, 'store']);
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::middleware('auth:sanctum')->group(function () {
    // Route to store a new Player ID
    Route::post('/player-id', [PlayerIdController::class, 'store']);

    // Route to delete a Player ID
    Route::delete('/player-id', [PlayerIdController::class, 'destroy']);

    // Route to get the authenticated user's details
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
