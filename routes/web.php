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
use App\Http\Controllers\PostController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppBookController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\CommentController;

use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome')->name('welcome');
Route::get('/makeappointment', [AppointmentController::class, 'appointmentcreate'])->name('makeappointment');
Route::post('/makeappointment', [AppointmentController::class, 'search'])->name('search.date');

Route::post('/bookedappointment', [AppBookController::class, 'store'])->name('app.book.store');
Route::get('/bookedappointment', [AppBookController::class, 'index'])->name('app.book.index');
Route::group(['middleware' => 'PreventBackHistory'], function () {
    Auth::routes();
    Route::get('home', 'App\Http\Controllers\HomeController@index');


    Route::get('/post', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/article/{post:slug}', [PostController::class, 'show'])->name('post.show');
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add');
    Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');

    Route::get('redirects', 'App\Http\Controllers\HomeController@index');

    //*getting all the doctor profiles
    Route::get('/doctorProfiles', [App\Http\Controllers\TotalDoctorProfiles::class, 'index']);


    //*profile photo upload
    Route::get('profile', [UserController::class, 'profile'])->name('doctor.image.show');
    Route::get('/registerChild', [ChildController::class, 'childcreate'])->name('childform');
    Route::post('/registerChild', [ChildController::class, 'store'])->name('child.store');
    Route::post('profile', [UserController::class, 'update_avatar'])->name('doctor.image.upload');
    Route::get('logout', [LoginController::class, 'logout']);
});
