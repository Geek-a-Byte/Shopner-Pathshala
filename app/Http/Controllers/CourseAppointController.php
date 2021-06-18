<?php

namespace App\Http\Controllers;

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

        $validator = Validator::make($request->all(), []);
        if ($validator->fails()) {
            return redirect('teacher.appoint.course')
                ->withErrors($validator)
                ->withInput();
        }
        var_dump($request->selectCourse);
        //$course = new Course;
        //$course->user()->associate($request->user());
        //$course->teacher_id = $user->teacher_id;
        //$course->course_level = $request->course_level;
        //$course->pre_requisite = $request->pre_requisite;
        //$course->course_name = $request->course_name;
        //$course->course_duration = $request->course_duration;
        //$course->course_content = $request->course_content;
        // $course_teacher = Teacher::find($user->teacher_id);
        // $course_teacher->courses()->save($course);
        // $course->save();


        include public_path('includes/connection.php');
        $checkbox1 = $request->selectCourse;
        $chk = "";
        foreach ($checkbox1 as $chk1) {
            $chk .= $chk1 . ",";
        }
        $in_ch = mysqli_query($con, "insert into request_quote(technology) values ('$chk')");
        $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();
        $sql = 'insert into child_course (course_code,course_level,course_name,course_duration,course_content,pre_requisite,teacher_id) values(:code,:level,:catagory,:duration,:content,:pre_requisite,:teacher_id); END;';
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':catagory', $catagory, 255);
        oci_bind_by_name($stmt, ':level', $level, 255);
        oci_bind_by_name($stmt, ':pre_requisite', $pre_requisite, 255);
        oci_bind_by_name($stmt, ':duration', $duration, 30, 0);
        oci_bind_by_name($stmt, ':code', $code, 255);
        oci_bind_by_name($stmt, ':teacher_id', $teacher_id, 300000, 0);
        oci_bind_by_name($stmt, ':content', $content, 255);
        $catagory = $request->course_name;
        $level = $request->course_level;
        $pre_requisite = $request->pre_requisite;
        $duration = $request->course_duration;
        $teacher_id = $user->teacher_id;
        $content = $request->course_content;
        oci_execute($stmt);
        return redirect()->back()->with('message', 'Course Created Successfully');
        if ($in_ch == 1) {
            echo '<script>alert("Inserted Successfully")</script>';
        } else {
            echo '<script>alert("Failed To Insert")</script>';
        }

        // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();
        // $sql = 'BEGIN create_course_code(:catagory,:code); insert into courses (course_code,course_level,course_name,course_duration,course_content,pre_requisite,teacher_id) values(:code,:level,:catagory,:duration,:content,:pre_requisite,:teacher_id); END;';
        // $stmt = oci_parse($conn, $sql);
        // oci_bind_by_name($stmt, ':catagory', $catagory, 255);
        // oci_bind_by_name($stmt, ':level', $level, 255);
        // oci_bind_by_name($stmt, ':pre_requisite', $pre_requisite, 255);
        // oci_bind_by_name($stmt, ':duration', $duration, 30, 0);
        // oci_bind_by_name($stmt, ':code', $code, 255);
        // oci_bind_by_name($stmt, ':teacher_id', $teacher_id, 300000, 0);
        // oci_bind_by_name($stmt, ':content', $content, 255);
        // $catagory = $request->course_name;
        // $level = $request->course_level;
        // $pre_requisite = $request->pre_requisite;
        // $duration = $request->course_duration;
        // $teacher_id = $user->teacher_id;
        // $content = $request->course_content;
        // oci_execute($stmt);
        // return redirect()->back()->with('message', 'Course Created Successfully');
    }
}
