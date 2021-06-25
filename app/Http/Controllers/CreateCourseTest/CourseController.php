<?php

namespace App\Http\Controllers\CreateCourseTest;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Exception;
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

        $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();
        $catagory = $request->course_name;
        $level = $request->course_level;
        $pre_requisite = $request->pre_requisite;
        $duration = $request->course_duration;
        $teacher_id = $user->teacher_id;
        $content = $request->course_content;


        include public_path('includes/connection.php');

        $sql = 'BEGIN insert into courses (course_level,course_name,course_duration,course_content,pre_requisite,teacher_id) values(:level,:catagory,:duration,:content,:pre_requisite,:teacher_id); END;';
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':catagory', $catagory, 255);
        oci_bind_by_name($stmt, ':level', $level, 255);
        oci_bind_by_name($stmt, ':pre_requisite', $pre_requisite, 255);
        oci_bind_by_name($stmt, ':duration', $duration, 30, 0);
        // oci_bind_by_name($stmt, ':code', $code, 255);
        oci_bind_by_name($stmt, ':teacher_id', $teacher_id, 300000, 0);
        oci_bind_by_name($stmt, ':content', $content, 255);

        try {
            oci_execute($stmt);
            // return redirect()->back()->with('message', 'Course Created Successfully');
        } catch (Exception $e) {
            $e = oci_error($stmt);
            echo "<pre>";
            echo htmlentities($e['sqltext']);
            printf("\n%" . ($e['offset'] + 1) . "s", "^");
            echo "</pre>";
            return redirect()->back()->with('message', htmlentities($e['message']));
        }

        return redirect()->back()->with('message', 'Course Created Successfully');
    }
}
