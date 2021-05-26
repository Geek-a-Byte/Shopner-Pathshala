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
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');
Route::group(['middleware' => 'PreventBackHistory'], function () {
    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::middleware('revalidate')->group(
//     function () {



//     }
// );


//* for admins
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('adminLogin');
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm'])->name('adminRegister');
Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::post('/login/admin', [LoginController::class, 'adminLogin']);

//* for writers
Route::get('/login/writer', [LoginController::class, 'showwriterLoginForm'])->name('writerLogin');
Route::get('/register/writer', [RegisterController::class, 'showwriterRegisterForm'])->name('writerRegister');
Route::post('/login/writer', [LoginController::class, 'writerLogin']);
Route::post('/register/writer', [RegisterController::class, 'createwriter']);


Route::group(
    ['middleware' => 'auth:writer'],
    function () {
        Route::view('/writer', 'writer');
    }
);

Route::group(
    ['middleware' => ['auth:admin']],
    function () {
        Route::view('/admin', 'admin');
    }
);

Route::get('logout', [LoginController::class, 'logout']);
