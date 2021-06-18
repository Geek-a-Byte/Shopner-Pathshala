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
        // var_dump($request->selectCourse);
        var_dump($request->child_id);
        include public_path('includes/connection.php');
        $checkbox1 = $request->selectCourse;
        // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();

        for ($i = 0; $i < count($checkbox1); $i++) {
            $check_id = $checkbox1[$i];
            $sql = 'BEGIN insert into child_takes_course (child_id,course_code) values(:child_id,:code); END;';
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ':child_id', $child_id, 255);
            oci_bind_by_name($stmt, ':code', $check_id, 255);
            $child_id = $request->child_id;
            oci_execute($stmt);
            // mysqli_query($conn, "insert into checkbox (category_id,subcategory_id) values ('1','" . $check_id . "')") or die(mysqli_error());
            // echo "Data added success fully!";
            // echo $check_id;
        }
        return redirect()->back()->with('message', 'Course Appointed Successfully');
        // $in_ch = mysqli_query($con, "insert into request_quote(technology) values ('$chk')");
        // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();
        // $sql = 'insert into child_course (course_code,course_level,course_name,course_duration,course_content,pre_requisite,teacher_id) values(:code,:level,:catagory,:duration,:content,:pre_requisite,:teacher_id); END;';
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
        // if ($in_ch == 1) {
        //     echo '<script>alert("Inserted Successfully")</script>';
        // } else {
        //     echo '<script>alert("Failed To Insert")</script>';
        // }

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
