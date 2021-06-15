<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Doctor;
use Illuminate\Http\Request;
use DB;
use Auth;

class AppBookController extends Controller
{
    //
    public function store(Request $request)
    {
        echo $request->app_time;
        $doctor = new Doctor;
        $user = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
        // var_dump($user);
        $guardian = Guardian::find($user->acct_holder_id);
        var_dump($guardian->acct_holder_id);
        $doctor->doctor_id = $request->selectdoctor;
        $guardian->doctors()->attach($guardian, ['doctor_id' => $request->selectdoctor, 'appointment_time' => $request->app_time]);
        // $doctor->guardians()->attach($doctor,);

        // return 'Success';
        return back()->with('message', 'Appointment Booking Success');
    }
}
