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
        $user = Auth::user();
        $filename = "default.jpg";
        var_dump($request->work_hour_from);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
            $user->avatar = $filename;
            $user->save();
        }

        $updateDoctorDetails = [
            'working_hour_from' => $request->work_hour_from,
            'working_hour_to' => $request->work_hour_to,
            'profile_photo' => $filename
        ];

        $updateGuardianDetails = [
            'profile_photo' => $filename
        ];

        if(Auth::user()->role == "Doctor"){
        DB::table('doctors')
            ->where('user_id', $user->id)
            ->update($updateDoctorDetails);
        }
        else if(Auth::user()->role == "Guardian"){
        DB::table('guardians')
            ->where('user_id', $user->id)
            ->update($updateGuardianDetails);
        }

        // if (Auth::user()->role == "Doctor") {

        //     DB::table('doctors')->where('doctor_email_id', $email)->updateMany([, 'working_hour_from' => $request->work_hour_from, 'working_hour_to' => $request->work_hour_to]);
        // } else if (Auth::user()->role == "Nurse") {

        //     DB::table('nurses')->where('nurse_email_id', $email)->update(['profile_photo' => $filename]);
        // } else if (Auth::user()->role == "Teacher") {

        //     DB::table('teachers')->where('teacher_email_id', $email)->update(['profile_photo' => $filename]);
        // } else if (Auth::user()->role == "Guardian") {

        //     DB::table('guardians')->where('acct_holder_email', $email)->update(['profile_photo' => $filename]);
        // }

        return back()->with('success', 'Profile updated.');
    }
}
