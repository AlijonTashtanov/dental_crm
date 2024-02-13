<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OnePolyclincTariffController;
use App\Http\Controllers\OnePolyclinicPaymentController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\PolyclinicPaymentController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TariffController;
use App\Http\Livewire\Admin\UserProfile;
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

Route::get('/', function () {
    return redirect('/admin');
});

//Jetstream
Route::middleware([
    'auth:sanctum',
    'admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//Cookies
Route::get('/set-cookie/{cookie}', [AdminController::class, 'setCookie'])->name('setCookie')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
//Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/tariffs', TariffController::class);
    Route::resource('/regions', RegionController::class);
    Route::resource('/polyclinics', PolyclinicController::class);
    Route::resource('/settings', SettingController::class);

    Route::group(['prefix' => 'one-polyclinic-payment', 'as' => 'one-polyclinic-payment.'], function () {
        Route::get('/index/{id}', [PolyclinicController::class, 'polyclinicPayments'])->name('index');
        Route::get('/create/{id}', [OnePolyclinicPaymentController::class, 'polyclinicPaymentCreate'])->name('create');
        Route::post('/store', [OnePolyclinicPaymentController::class, 'polyclinicPaymentStore'])->name('store');
        Route::get('/edit/{id}', [OnePolyclinicPaymentController::class, 'polyclinicPaymentEdite'])->name('edit');
        Route::put('/update/{id}', [OnePolyclinicPaymentController::class, 'polyclinicPaymentUpdate'])->name('update');
        Route::delete('/destroy/{id}', [OnePolyclinicPaymentController::class, 'polyclinicPaymentDestroy'])->name('destroy');
    });

    Route::group(['prefix' => 'one-polyclinic-tariff', 'as' => 'one-polyclinic-tariff.'], function () {
        Route::get('/index/{id}', [PolyclinicController::class, 'polyclinicTariffs'])->name('index');
        Route::get('/create/{id}', [OnePolyclincTariffController::class, 'polyclinicTariffCreate'])->name('create');
        Route::post('/store', [OnePolyclincTariffController::class, 'polyclinicTariffStore'])->name('store');
//        Route::get('/edit/{id}', [OnePolyclincTariffController::class, 'polyclinicTariffEdite'])->name('edit');
//        Route::put('/update/{id}', [OnePolyclincTariffController::class, 'polyclinicTariffUpdate'])->name('update');
        Route::delete('/destroy/{id}', [OnePolyclincTariffController::class, 'polyclinicTariffDestroy'])->name('destroy');
    });

//Profile
    Route::get('/profile', UserProfile::class)->name('profile');
    Route::post('/changeData', [AdminController::class, 'data'])->name('data');
    Route::get('/password/index', [AdminController::class, 'password'])->name('profile.password');
    Route::post('/password/index', [AdminController::class, 'passwordChange'])->name('password.change.index');
});


