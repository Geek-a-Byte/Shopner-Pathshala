<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Models\Doctor;
use Illuminate\Http\Request;
use DB;
use Auth;

class AppBookController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        // echo $app_time;
        $guardian = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
        // $users = DB::table('childs')->where('acct_holder_id', $guardian->acct_holder_id)->get(); //var_dump($guardian);
        // var_dump($users);
        $c_code = $request->child_id;
        $g_id = $guardian->acct_holder_id;
        $app_start_time = $request->app_time;
        $app_end_time = $request->app_end_time;
        $checkbox = $request->selectdoctor;
        $data = DB::table('childs')->where('acct_holder_id', $g_id)
            ->where('child_id', $c_code)->value('child_id');
        if (is_null($data)) {
            return back()->with('message', 'invalid child id...!');
        } else {
            if ($c_code != '' and $app_end_time != '' and $app_start_time != '' and $checkbox != '') {
                echo $request->app_time;
                $doctor = new Doctor;
                $user = DB::table('guardians')->where('user_id', Auth::user()->id)->first();

                // var_dump($user);
                $guardian = Guardian::find($user->acct_holder_id);
                var_dump($guardian->acct_holder_id);
                $doctor->doctor_id = $request->selectdoctor;
                $guardian->doctors()->attach($guardian, ['doctor_id' => $checkbox, 'child_id' => $c_code, 'appointment_time' => $app_start_time, 'appointment_end_time' => $app_end_time]);
                return back()->with('message', 'Appointment Booking Success');
            } else {
                return back()->with('message', 'Doctor ID missing! select a doctor from the list');
            }
        }
    }
}
