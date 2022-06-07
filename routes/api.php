<?php

use App\Http\Controllers\Api\BorzoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('borzo/status', [BorzoController::class, 'index']);
Route::post('borzo/price', [BorzoController::class, 'store']);
Route::post('borzo/order', [BorzoController::class, 'new_order']);
