<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewCoursesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('viewCourse');
    }
    public function store()
    {
        // return view('appointCourse');
    }
    public function search(Request $request)
    {
        $child = $request->child_id;
        // echo $app_time;
        include public_path('includes/connection.php');
        $stid = oci_parse($conn, 'select C.course_code,C.course_level,C.course_name,C.course_duration,C.course_content,C.pre_requisite,T.teacher_name
        from  courses C 
        join child_course H on C.course_code=H.course_code
        join teachers T on C.teacher_id=T.teacher_id
        join childs Y on  H.child_id=Y.child_id
        where Y.child_id=:child;');
        oci_bind_by_name($stid, ":child", $child);
        oci_execute($stid);
        $data = array();
        $i = 0;
        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $data[] = $row;
        }
        // var_dump($data);
        // echo "<table border='1'>\n";
        // while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //     echo "<tr>\n";
        //     foreach ($row as $item) {
        //         echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        //     }
        //     echo "</tr>\n";
        // }
        // echo "</table>\n";

        // var_dump($data);
        if (count($data) == 0) {

            return back()->with('message', 'no child found...!');
        }

        return view('view', compact('child', 'data'));
    }
}
