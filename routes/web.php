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

//* for teachers
Route::get('/login/teacher', [LoginController::class, 'showTeacherLoginForm'])->name('teacherLogin');
Route::get('/register/teacher', [RegisterController::class, 'showTeacherRegisterForm'])->name('teacherRegister');
Route::post('/login/teacher', [LoginController::class, 'teacherLogin']);
Route::post('/register/teacher', [RegisterController::class, 'createTeacher']);

//* for guardians
Route::get('/login/guardian', [LoginController::class, 'showGuardianLoginForm'])->name('guardianLogin');
Route::get('/register/guardian', [RegisterController::class, 'showGuardianRegisterForm'])->name('guardianRegister');
Route::post('/login/guardian', [LoginController::class, 'guardianLogin']);
Route::post('/register/guardian', [RegisterController::class, 'createGuardian']);

//* for doctors
Route::get('/login/doctor', [LoginController::class, 'showDoctorLoginForm'])->name('doctorLogin');
Route::get('/register/doctor', [RegisterController::class, 'showDoctorRegisterForm'])->name('doctorRegister');
Route::post('/login/doctor', [LoginController::class, 'doctorLogin']);
Route::post('/register/doctor', [RegisterController::class, 'createDoctor']);


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
Route::group(
    ['middleware' => ['auth:teacher']],
    function () {
        Route::view('/teacher', 'teacher');
    }
);


Route::group(
    ['middleware' => ['auth:guardian']],
    function () {
        Route::view('/guardian', 'guardian');
    }
);


Route::group(
    ['middleware' => ['auth:doctor']],
    function () {
        Route::view('/doctor', 'doctor');
    }
);

Route::get('logout', [LoginController::class, 'logout']);
