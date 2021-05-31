<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Writer;
use App\Models\Teacher;
use App\Models\Guardian;
use App\Models\Doctor;
use App\Models\Nurse;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:writer');
        $this->middleware('guest:teacher');
        $this->middleware('guest:guardian');
        $this->middleware('guest:doctor');
        $this->middleware('guest:nurse');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdminRegisterForm()
    {
        return view('auth.admin.register', ['url' => 'admin']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTeacherRegisterForm()
    {
        return view('auth.teacher.register', ['url' => 'teacher']);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showGuardianRegisterForm()
    {
        return view('auth.guardian.register', ['url' => 'guardian']);
    }

     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDoctorRegisterForm()
    {
        return view('auth.doctor.register', ['url' => 'doctor']);
    }


     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNurseRegisterForm()
    {
        return view('auth.nurse.register', ['url' => 'nurse']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showWriterRegisterForm()
    {
        return view('auth.writer.register', ['url' => 'writer']);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return redirect()->intended('login/user');
    }

    protected function createTeacher(Request $request)
    {
        // $data = array();
        // $data = $request->all();
        // var_dump($data);

        // var_dump($request->email);
        // var_dump($request->password);
        // var_dump($request->gender);
        // var_dump($request->address);

        $this->validator($request->all())->validate();
        Teacher::create([
            'teacher_name' => $request->name,
            'teacher_email_id' => $request->email,
            'password' => Hash::make($request->password),
            'teacher_gender' => $request->gender,
            'teacher_address' => $request->address,
        ]);

        return redirect()->intended('login/teacher');
    }
    protected function createGuardian(Request $request)
    {
        $data = array();
        $data = $request->all();
        var_dump($data);

        // var_dump($request->email);
        var_dump($request->password);
        // var_dump($request->gender);
        // var_dump($request->address);

        $this->validator($request->all())->validate();
        Guardian::create([
            'acct_holder_name' => $request->name,
            'acct_holder_email' => $request->email,
            'password' => Hash::make($request->password),
            'acct_holder_address' => $request->address,
            'acct_holder_gender' => $request->gender,
            'relation_with_child' => $request->relation,
        ]);

        return redirect()->intended('login/guardian');
    }
    protected function createDoctor(Request $request)
    {
        $data = array();
        $data = $request->all();
        var_dump($data);

        // var_dump($request->email);
        var_dump($request->password);
        // var_dump($request->gender);
        // var_dump($request->address);

        $this->validator($request->all())->validate();
        Doctor::create([
            'doctor_name' => $request->name,
            'doctor_email_id' => $request->email,
            'password' => Hash::make($request->password),
            'doctor_address' => $request->address,
            'doctor_gender' => $request->gender,
            'doctor_designation' => $request->designation,
        ]);

        return redirect()->intended('login/doctor');
    }

    protected function createNurse(Request $request)
    {
        $data = array();
        $data = $request->all();
        var_dump($data);

        // var_dump($request->email);
        var_dump($request->password);
        // var_dump($request->gender);
        // var_dump($request->address);

        $this->validator($request->all())->validate();
        Nurse::create([
            'nurse_name' => $request->name,
            'nurse_email_id' => $request->email,
            'password' => Hash::make($request->password),
            'nurse_address' => $request->address,
            'nurse_gender' => $request->gender,
        ]);

        return redirect()->intended('login/nurse');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createAdmin(Request $request)
    {
        // $data = array();
        // $data = $request->all();
        // var_dump($data);
        $this->validator($request->all())->validate();
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->intended('login/admin');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createWriter(Request $request)
    {
        $this->validator($request->all())->validate();
        Writer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->intended('login/writer');
    }

    
}
