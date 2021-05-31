<?php

namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Image;

class DoctorProfilePicUpdate extends Controller
{
    //
    public function profile()
    {
        // $user =  Auth::guard('doctor');
        return view('auth.doctor.profile', array('user' => Auth::guard('doctor')->user()));
        // return view('', compact('user'));
    }

    public function update_avatar(Request $request)
    {
        // Handle the user upload of avatar
        if ($request->hasFile('profile_photo')) {
            $profile_photo = $request->file('profile_photo');
            $filename = time() . '.' . $profile_photo->getClientOriginalExtension();
            Image::make($profile_photo)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
            $user = Auth::guard('doctor')->user();
            $user->profile_photo = $filename;
            $user->save();
        }

        return view(
            'auth.doctor.profile',
            array('doctor' => Auth::guard('doctor'))
        );
    }
}
