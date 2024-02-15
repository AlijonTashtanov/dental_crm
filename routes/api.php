<?php

use App\Http\Controllers\Api\DiseaseController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PaymentTypeController;
use App\Http\Controllers\Api\PolyclinicController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReceptionController;
use App\Http\Controllers\Api\ServiceCategoryController;
use App\Http\Controllers\Api\TariffController;
use App\Http\Controllers\Api\TechnicController;
use App\Http\Controllers\Api\TelegramUserController;
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
    Route::post('/doctor-login', [PolyclinicController::class, 'doctorLogin']);
});

Route::get('/regions', [PolyclinicController::class, 'regions']);

// Auth user
Route::middleware(['auth:api'])->group(function () {
    // Profile
    Route::group(['prefix' => 'profile'], function () {
        Route::post('/logout', [ProfileController::class, 'logout']);
    });
});


// Super Admin rule
Route::middleware(['auth:api', 'api_admin'])->group(function () {
    Route::group(['prefix' => 'staff'], function () {

        Route::get('/index', [DoctorController::class, 'index']);
        Route::get('/show/{id}', [DoctorController::class, 'show']);
        Route::delete('/delete/{id}', [DoctorController::class, 'destroy']);
        Route::get('/checkSortOrder', [DoctorController::class, 'checkSortOrder']);
        Route::get('/search', [DoctorController::class, 'search']);

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

    // Service Category
    Route::group(['prefix' => 'service'], function () {
        // category
        Route::get('/category/index', [ServiceCategoryController::class, 'index']);
        Route::post('/category/create', [ServiceCategoryController::class, 'createCategory']);
        Route::put('/category/update/{id}', [ServiceCategoryController::class, 'updateCategory']);
        Route::delete('/category/delete/{id}', [ServiceCategoryController::class, 'destroyCategory']);

        // service
        Route::post('/create', [ServiceCategoryController::class, 'createService']);
        Route::put('/update/{id}', [ServiceCategoryController::class, 'updateService']);
        Route::delete('/delete/{id}', [ServiceCategoryController::class, 'serviceDestroy']);

    });

    Route::group(['prefix' => 'patient'], function () {
        Route::get('/index', [PatientController::class, 'index']);
        Route::post('/create', [PatientController::class, 'create']);
        Route::put('/update/{id}', [PatientController::class, 'update']);
        Route::delete('/delete/{id}', [PatientController::class, 'delete']);
        Route::get('/search', [PatientController::class, 'search']);
        Route::get('/debtors', [PatientController::class, 'debtors']);
    });

    // Kasalliklar
    Route::group(['prefix' => 'disease'], function () {
        Route::get('/index', [DiseaseController::class, 'index']);
        Route::get('/search', [DiseaseController::class, 'search']);
        Route::post('/create', [DiseaseController::class, 'create']);
        Route::put('/update/{id}', [DiseaseController::class, 'update']);
        Route::delete('/delete/{id}', [DiseaseController::class, 'delete']);
    });

    // Telegram
    Route::group(['prefix' => 'users-telegram'], function () {
        Route::get('/index', [TelegramUserController::class, 'index']);
        Route::post('/create', [TelegramUserController::class, 'create']);
        Route::put('/update/{id}', [TelegramUserController::class, 'update']);
        Route::delete('/delete/{id}', [TelegramUserController::class, 'delete']);
        Route::get('/search', [TelegramUserController::class, 'search']);
    });

    // Payment types
    Route::group(['prefix' => 'payment-type'], function () {
        Route::get('/index', [PaymentTypeController::class, 'index']);
        Route::post('/create', [PaymentTypeController::class, 'create']);
        Route::put('/update/{id}', [PaymentTypeController::class, 'update']);
        Route::delete('/delete/{id}', [PaymentTypeController::class, 'delete']);
    });

});

// Reception rule
Route::middleware(['auth:api', 'api_reception'])->group(function () {

    // Patient
    Route::group(['prefix' => 'patient'], function () {
        Route::get('/index', [PatientController::class, 'index']);
        Route::post('/create', [PatientController::class, 'create']);
        Route::put('/update/{id}', [PatientController::class, 'update']);
        Route::get('/search', [PatientController::class, 'search']);
        Route::get('/debtors', [PatientController::class, 'debtors']);
    });

});

Route::get('/tariffs', [TariffController::class, 'index']);
