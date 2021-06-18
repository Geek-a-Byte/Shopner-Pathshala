<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role == "Doctor") {
            return redirect($this->redirectTo);
            // return view('auth.doctor.profile');
        } else if ($user->role == "Nurse") {
            return view('auth.nurse.profile');
        } else if ($user->role == "Teacher") {
            return view('auth.teacher.profile');
        } else if ($user->role == "Guardian") {
            return view('auth.guardian.profile');
        } else {
            return view('auth.doctor.profile');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:writer')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
        $this->middleware('guest:guardian')->except('logout');
        $this->middleware('guest:doctor')->except('logout');
        $this->middleware('guest:nurse')->except('logout');
    }
}
