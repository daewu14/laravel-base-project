<?php

use App\Http\Controllers\BorzoController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['cors'])->group(function () {
    Route::resource('/user', UserController::class);
    Route::resource('/buku', BukuController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show']);

    Route::get('borzo', [BorzoController::class, 'index'])->name('borzo');
    Route::post('borzo', [BorzoController::class, 'store'])->name('cektarif');
    Route::get('borzo/http', [BorzoController::class, 'http_coba']);
    Route::post('borzo/new', [BorzoController::class, 'new_order'])->name('new_order');
});
