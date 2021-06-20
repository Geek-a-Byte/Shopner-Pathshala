<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('testform');
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
        $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();
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

    
    // public function search()
    // {
    //     $courses = DB::table('courses')->where()->pluck("course_code");
    //     return view('dropdown',compact('courses'));
    //     // $c_code = $request->course_code;
    //     // // echo $app_time;
    //     // include public_path('includes/connection.php');
    //     // $stid = oci_parse($conn, 'SELECT test_question FROM tests where course_code=:c_code');
    //     // oci_bind_by_name($stid, ":c_code",$c_code);
    //     // oci_execute($stid);
    //     // $data = array();
    //     // $i = 0;
    //     // while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    //     //     $data[] = $row;
    //     // }
    //     // var_dump($data);
    //     // echo "<table border='1'>\n";
    //     // while ($  row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    //     //     echo "<tr>\n";
    //     //     foreach ($row as $item) {
    //     //         echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    //     //     }
    //     //     echo "</tr>\n";
    //     // }
    //     // echo "</table>\n";

    //     // var_dump($data);
    //     // if (count($data) == 0) {

    //     //     return back()->with('message', 'no test found...!');
    //     // }

    //     return view('testform', compact('data'));
    // }
}