<?php

use App\Http\Controllers\Api\PolyclinicController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\ReceptionController;
use App\Http\Controllers\Api\TechnicController;
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

Route::middleware(['auth:api', 'api_admin'])->group(function () {
    Route::group(['prefix' => 'staff'], function () {
        Route::get('/index', [DoctorController::class, 'index']);
        Route::get('/show/{id}', [DoctorController::class, 'show']);
        Route::delete('/delete/{id}', [DoctorController::class, 'destroy']);
        // Doctor
        Route::post('/doctor/create', [DoctorController::class, 'create']);
        Route::put('/doctor/update/{id}', [DoctorController::class, 'update']);

        // Reception
        Route::post('/reception/create', [ReceptionController::class, 'create']);
        Route::put('/reception/update/{id}', [ReceptionController::class, 'update']);

        // Technic
        Route::post('/technic/create', [TechnicController::class, 'create']);
        Route::put('/technic/update/{id}', [TechnicController::class, 'update']);
    });
});

