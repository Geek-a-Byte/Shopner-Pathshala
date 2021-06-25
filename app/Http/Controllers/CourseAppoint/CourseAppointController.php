<?php

namespace App\Http\Controllers\CourseAppoint;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CourseAppointController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('appointCourse');
    }
    public function store(Request $request)
    {
        // var_dump($request);

        $validator = Validator::make($request->all(), []);
        if ($validator->fails()) {
            return redirect('teacher.appoint.course')
                ->withErrors($validator)
                ->withInput();
        }
        // var_dump($request->selectCourse);
        echo $request->child_id;
        include public_path('includes/connection.php');
        $checkbox1 = $request->selectCourse;
        $child_id = $request->child_id;
        // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();
        if ($checkbox1 != '' and $child_id != '') {
            for ($i = 0; $i < count($checkbox1); $i++) {
                $check_id = $checkbox1[$i];
                $sql = 'BEGIN insert into child_takes_course (child_id,course_code) values(:child_id,:code); END;';
                $stmt = oci_parse($conn, $sql);
                oci_bind_by_name($stmt, ':child_id', $child_id, 255);
                oci_bind_by_name($stmt, ':code', $check_id, 255);
                oci_execute($stmt);
            }
            return redirect()->back()->with('message', 'Course Appointed Successfully');
        } else {
            return redirect()->back()->with('message', 'No Course Selected');
        }
    }
}
