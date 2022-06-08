<?php

use App\Http\Controllers\Api\AuthController;
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
    return response()->json(['hai']);
});

Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('borzo/status', [BorzoController::class, 'index']);
    Route::post('borzo/price', [BorzoController::class, 'store']);
    Route::post('borzo/order', [BorzoController::class, 'new_order']);
    Route::post('logout', [AuthController::class, 'logout']);
});

