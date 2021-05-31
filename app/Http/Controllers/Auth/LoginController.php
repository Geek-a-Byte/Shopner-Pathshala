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
    public function showUserLoginForm()
    {
        return view('auth.login', ['url' => 'user']);
    }
    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }
    public function showTeacherLoginForm()
    {
        return view('auth.login', ['url' => 'teacher']);
    }
    public function showwriterLoginForm()
    {
        return view('auth.login', ['url' => 'writer']);
    }
    public function showGuardianLoginForm()
    {
        return view('auth.login', ['url' => 'guardian']);
    }
    public function showDoctorLoginForm()
    {
        return view('auth.login', ['url' => 'doctor']);
    }
    public function showNurseLoginForm()
    {
        return view('auth.login', ['url' => 'nurse']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    public function writerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('writer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/writer');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function teacherLogin(Request $request)
    {
        // {
        //     $data = array();
        //     $data = $request->all();
        //     var_dump($data);

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('teacher')->attempt([
            'teacher_email_id' => $request->email,
            'password' => $request->password
        ], $request->get('remember'))) {

            return redirect()->intended('/teacher');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function guardianLogin(Request $request)
    {
        // {
        //     $data = array();
        //     $data = $request->all();
        //     var_dump($data);

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('guardian')->attempt([
            'acct_holder_email' => $request->email,
            'password' => $request->password
        ], $request->get('remember'))) {

            return redirect()->intended('/guardian');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function doctorLogin(Request $request)
    {
        // {
        //     $data = array();
        //     $data = $request->all();
        //     var_dump($data);

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('doctor')->attempt([
            'doctor_email_id' => $request->email,
            'password' => $request->password
        ], $request->get('remember'))) {

            return redirect()->intended('/doctor');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function nurseLogin(Request $request)
    {
        // {
        //     $data = array();
        //     $data = $request->all();
        //     var_dump($data);

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('nurse')->attempt([
            'nurse_email_id' => $request->email,
            'password' => $request->password
        ], $request->get('remember'))) {

            return redirect()->intended('/nurse');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

}
