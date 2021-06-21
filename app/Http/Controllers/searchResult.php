<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class searchResult extends Controller
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

    public function search(Request $request)
    {
        $c_code = $request->child_id;
        $category = $request->course_name;
        $user = DB::table('childs')->where('child_id', $c_code)->first();

        if (is_null($user)) {
            return back()->with('message', 'invalid child id...!');
        }

        include public_path('includes/connection.php');
        // $stid = oci_parse($conn, 'SELECT CI.child_id,course_name,course_level,course_code,test_code,pre_requisite,score from courses C
        //                         inner join child_takes_course CI USING(course_code)
        //                         inner join tests T USING(course_code)
        //                         inner join results R USING(test_code)
        //                         where CI.child_id=:c_code and R.child_id=:c_code and C.course_name=:category');

        //*for new student
        $stid = oci_parse($conn, 'SELECT * from child_takes_course where child_id=:c_code');
        oci_bind_by_name($stid, ":c_code", $c_code);
        oci_execute($stid);
        $data = array();
        $i = 0;
        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $data[] = $row;
        }

        if (count($data) == 0) {
            $new_student = 'yes';
            // echo "yes";
            $easy = 'easy';
            $stid = oci_parse($conn, 'SELECT * from courses where course_level=:easy');
            oci_bind_by_name($stid, ":easy", $easy);
            oci_execute($stid);
            $data = array();
            $i = 0;
            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $data[] = $row;
            }
            // var_dump($data);
            return view('appointCourse', compact('new_student', 'c_code', 'data'));
        } else { //*for previous student
            $new_student = 'no';
            $stid = oci_parse($conn, 'SELECT R.child_id,C.pre_requisite as standard_course,R.score as standard_course_score,C.course_code  as course_that_can_be_appointed,C.course_name,c.course_content,c.course_duration,c.course_level AS APPOINT_COURSE_LEVEL
                                    from tests T join Results R on R.test_code=T.test_code join courses C on C.pre_requisite=T.course_code where R.child_id=:c_code and R.score>=10 and C.course_code not in (select course_code from child_takes_course)');
            oci_bind_by_name($stid, ":c_code", $c_code);
            // oci_bind_by_name($stid, ":category", $category);
            oci_execute($stid);
            $data = array();
            $i = 0;
            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $data[] = $row;
            }
            if (count($data) != 0) {
                // echo "yes";
                return view('appointCourse', compact('new_student', 'c_code', 'data'));
            } else {
                return back()->with('message', 'No Appropriate Courses Found');
            }

            // var_dump($data);
        }
    }
}
