<?php

use App\Http\Controllers\Api\PolyclinicController;
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


Route::group(['prefix' => 'polyclinic'], function () {
    Route::post('/register', [PolyclinicController::class, 'register']);
    Route::post('/verify', [PolyclinicController::class, 'verify']);
    Route::post('/login', [PolyclinicController::class, 'login']);
});
