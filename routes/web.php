<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegionController;
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
    Route::resource('/clinics', \App\Http\Controllers\ClinicController::class);

//Profile
    Route::get('/profile', UserProfile::class)->name('profile');
    Route::post('/changeData', [AdminController::class, 'data'])->name('data');
    Route::get('/password/index', [AdminController::class, 'password'])->name('profile.password');
    Route::post('/password/index', [AdminController::class, 'passwordChange'])->name('password.change.index');
});


