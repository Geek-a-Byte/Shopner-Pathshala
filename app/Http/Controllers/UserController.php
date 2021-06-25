<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use DB;
use DateTime;

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

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
            $user->avatar = $filename;
            $user->save();
        }
        $work_time_from = $request->work_hour_from;
        $work_time_to = $request->work_hour_to;

        if ($work_time_from != '' and $work_time_to != '') {
            $now = new DateTime();
            $now = $now->format('d-M-y H:i');

            if (strtotime($work_time_from) < strtotime($now)) {
                return redirect()->back()->with('success', 'Working Hour From DateTime is in the past');
            }
            if (strtotime($work_time_to) < strtotime($now)) {
                return redirect()->back()->with('success', 'Working Hour To DateTime is in the past');
            }
            if (strtotime($work_time_to) < strtotime($work_time_from)) {
                return redirect()->back()->with('success', 'Working Hour To DateTime is smaller than Working Hour From');
            }
            $updateDoctorDetails = [
                'working_hour_from' => $request->work_hour_from,
                'working_hour_to' => $request->work_hour_to,
                'profile_photo' => $filename
            ];
            if (Auth::user()->role == "Doctor") {
                DB::table('doctors')
                    ->where('user_id', $user->id)
                    ->update($updateDoctorDetails);
            }
            return back()->with('success', 'Profile updated.');
        } else {
            return redirect()->back()->with('success', 'INFO missing of working hour time interval');
        }
    }
}
