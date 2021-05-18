<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ReviewController;
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

Route::get('/', function () {
    return 200;
});


Route::post('/search', [AddressController::class, 'search']);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('reviews', ReviewController::class);
