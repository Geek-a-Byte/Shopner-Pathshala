<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Writer;
use App\Models\Teacher;
use App\Models\Guardian;
use App\Models\Doctor;
use App\Models\Nurse;
// use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
    // protected $redirectTo = '/login';
    protected $redirectTo = '/login';

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $request->session()->flash('notification', 'Thank you for subscribing!');
        return redirect($this->redirectTo)->with('message', 'Registered successfully, please login...!');
    }
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

    protected function create(array $data)
    {

        $this->validator($data)->validate();
        $user = User::create([
            'name' => $data['name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if ($user->role == 'Doctor') {
            Doctor::create([
                'user_id' => $user->id,
                'doctor_name' => $data['name'],
                'doctor_email_id' => $data['email'],
                'password' => Hash::make($data['password']),
                'doctor_address' => $data['doctor_address'],
                'doctor_gender' => $data['doctor_gender'],
                'doctor_designation' => $data['doctor_designation'],

            ]);
        } else if ($user->role == 'Teacher') {
            Teacher::create(
                [
                    'user_id' => $user->id,
                    'teacher_name' => $data['name'],
                    'teacher_email_id' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'teacher_gender' => $data['teacher_gender'],
                    'teacher_address' => $data['teacher_address'],
                ]
            );
        } else if ($user->role == 'Guardian') {
            Guardian::create([
                'user_id' => $user->id,
                'acct_holder_name' => $data['name'],
                'acct_holder_email' => $data['email'],
                'password' => Hash::make($data['password']),
                'acct_holder_address' => $data['guardian_address'],
                'acct_holder_gender' => $data['guardian_gender'],
                'relation_with_child' => $data['relation'],

            ]);
        } else if ($user->role == 'Nurse') {
            Nurse::create([
                'user_id' => $user->id,
                'nurse_name' => $data['name'],
                'nurse_email_id' => $data['email'],
                'password' => Hash::make($data['password']),
                'nurse_address' => $data['address'],
                'nurse_gender' => $data['gender'],
            ]);
        }
        return $user;
    }
}
