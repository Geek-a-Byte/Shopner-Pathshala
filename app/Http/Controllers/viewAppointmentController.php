<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;

class viewAppointmentController extends Controller
{
    //
    public function index()
    {
        return view('viewAppointment');
    }
    public function store(Request $request)
    {
        // return view('createCourse');
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {

            return redirect('teacher.create.course')
                ->withErrors($validator)
                ->withInput();
        }
        include public_path('includes/connection.php');
        $user = DB::table('doctors')->where('user_id', Auth::user()->id)->first();
        $sql = 'BEGIN insert into tests (course_code,test_question,teacher_id) values(:code,:content,:teacher_id); END;';
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':code', $code, 255);
        oci_bind_by_name($stmt, ':teacher_id', $teacher_id, 300000, 0);
        oci_bind_by_name($stmt, ':content', $content, 255);
        $teacher_id = $user->teacher_id;
        $code = $request->course_code;
        $content = $request->course_content;
        oci_execute($stmt);
        return redirect()->back()->with('message', 'Test Created Successfully');
    }
}
