<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use DB;

class UserController extends Controller
{
    //
    public function profile()
    {
        if (Auth::user()->role == "Doctor")
            return view('auth.doctor.profile', array('user' => Auth::user()));
        else if (Auth::user()->role == "Nurse")
            return view('auth.nurse.profile', array('user' => Auth::user()));
        else if (Auth::user()->role == "Teacher")
            return view('auth.teacher.profile', array('user' => Auth::user()));
        else if (Auth::user()->role == "Guardian")
            return view('auth.guardian.profile', array('user' => Auth::user()));
    }
    public function update_avatar(Request $request)
    {

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            if (Auth::user()->role == "Doctor") {

                $email = Auth::user()->email;
                DB::table('doctors')->where('doctor_email_id', $email)->update(['profile_photo' => $filename]);
            } else if (Auth::user()->role == "Nurse") {

                $email = Auth::user()->email;
                DB::table('nurses')->where('nurse_email_id', $email)->update(['profile_photo' => $filename]);
            } else if (Auth::user()->role == "Teacher") {

                $email = Auth::user()->email;
                DB::table('teachers')->where('teacher_email_id', $email)->update(['profile_photo' => $filename]);
            } else if (Auth::user()->role == "Guardian") {

                $email = Auth::user()->email;
                DB::table('guardians')->where('acct_holder_email', $email)->update(['profile_photo' => $filename]);
            }
        }

        if (Auth::user()->role == "Doctor")
            return view('auth.doctor.profile', array('user' => Auth::user()));
        else if (Auth::user()->role == "Nurse")
            return view('auth.nurse.profile', array('user' => Auth::user()));
        else if (Auth::user()->role == "Teacher")
            return view('auth.teacher.profile', array('user' => Auth::user()));
        else if (Auth::user()->role == "Guardian")
            return view('auth.guardian.profile', array('user' => Auth::user()));
    }
}
