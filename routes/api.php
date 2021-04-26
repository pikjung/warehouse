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
use App\Http\Controllers\dashboardController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::get('/api/dashboard', [dashboardController::class, 'index'])->name('home');
    Route::post('/dashboard/serial', [dashboardController::class, 'serial']);
    Route::post('/dashboard/checkDN', [dashboardController::class, 'checkDN']);

