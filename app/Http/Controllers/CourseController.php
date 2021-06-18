<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('createCourse');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {

            return redirect('teacher.create.course')
                ->withErrors($validator)
                ->withInput();
        }


        $course = new Course;
        $course->user()->associate($request->user());
        $course->course_level = $request->course_level;
        $course->pre_requisite = $request->pre_requisite;
        $course->course_name = $request->course_name;
        $course->course_duration = $request->course_duration;
        $user = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
        $child->acct_holder_id = $user->acct_holder_id;
        $child_guardian = Guardian::find($user->acct_holder_id);
        $child_guardian->childs()->save($child);
        $child->save();



        return redirect()->back()->with('message', 'Appointment Booking Success');
    }
}
