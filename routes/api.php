<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VerificationController;
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



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/search', [AddressController::class, 'search']);
Route::get('/terms', [Controller::class, 'terms']);


Route::middleware('auth:api')->group(function () {
    Route::get('/email/verify', [AuthController::class, 'verify']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/create', [Controller::class, 'create']);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('reviews', ReviewController::class);
});


Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('auth/{provider}', [SocialController::class, 'redirect']);
Route::get('auth/{provider}/callback', [SocialController::class], 'callback');
