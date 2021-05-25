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


Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/login/writer', 'App\Http\Controllers\Auth\LoginController@showWriterLoginForm')->name('login.writer');
Route::get('/register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/register/writer', 'App\Http\Controllers\Auth\RegisterController@showWriterRegisterForm')->name('register.writer');

Route::post('/login/admin', 'App\Http\Controllers\Auth\LoginController@adminLogin');
Route::post('/login/writer', 'App\Http\Controllers\Auth\LoginController@writerLogin');
Route::post('/register/admin', 'App\Http\Controllers\Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/register/writer', 'App\Http\Controllers\Auth\RegisterController@createWriter')->name('register.writer');

Route::view('/home', 'home')->middleware('auth');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::group(['middleware' => 'auth:writer'], function () {
    Route::view('/writer', 'writer');
});
