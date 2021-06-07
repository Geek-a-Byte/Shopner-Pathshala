<?php

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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Profile\DoctorProfilePicUpdate;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome')->name('welcome');
Route::view('/makeappointment', 'makeappointment')->name('makeappointment');
Route::group(['middleware' => 'PreventBackHistory'], function () {
    Auth::routes();
    Route::get('home', 'App\Http\Controllers\HomeController@index');
});

Route::get('redirects', 'App\Http\Controllers\HomeController@index');

//*getting all the doctor profiles
Route::get('/doctorProfiles', [App\Http\Controllers\TotalDoctorProfiles::class, 'index']);


//*profile photo upload
Route::get('profile', [UserController::class, 'profile'])->name('doctor.image.show');
Route::view('/registerChild', 'guardian/childform')->name('childform');
Route::post('profile', [UserController::class, 'update_avatar'])->name('doctor.image.upload');
Route::get('logout', [LoginController::class, 'logout']);
