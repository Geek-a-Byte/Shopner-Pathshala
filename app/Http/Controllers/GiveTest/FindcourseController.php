<?php

namespace App\Http\Controllers\GiveTest;

use App\Http\Controllers\Controller;

use DB;
use Auth;
use Illuminate\Http\Request;

class FindcourseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function search(Request $request)
    {
        // echo $app_time;
        $guardian = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
        $users = DB::table('childs')->where('acct_holder_id', $guardian->acct_holder_id)->get(); //var_dump($guardian);
        // var_dump($users);
        $c_code = $request->child_id;
        $g_id = $guardian->acct_holder_id;
        $ajaira = DB::table('childs')->where('acct_holder_id', $g_id)
            ->where('child_id', $c_code)->value('child_id');
        // echo $ajaira;
        if (is_null($ajaira)) {
            return back()->with('message', 'invalid child id...!');
        }
        // echo $g_id;

        include public_path('includes/connection.php');
        $stid = oci_parse($conn, 'SELECT course_code,course_level,test_code
        from courses join tests using(course_code) join child_takes_course using(course_code)
        where child_id = :ajaira order by test_code');
        // $stid = oci_parse($conn, 'SELECT course_code FROM child_takes_course where child_id=:c_code');
        oci_bind_by_name($stid, ":ajaira", $ajaira);
        // oci_bind_by_name($stid, ":c_code",$c_code);
        oci_execute($stid);
        $data = array();
        $i = 0;
        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $data[] = $row;
        }
        // var_dump($data);

        // var_dump($data);
        // while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //     $WID=$row ['course_code'];
        //     echo "<option value='". $WID ."'>" .$WID ."</option>";
        // }
        // var_dump($data);
        // echo "<table border='1'>\n";
        // while ($  row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //     echo "<tr>\n";
        //     foreach ($row as $item) {
        //         echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        //     }
        //     echo "</tr>\n";
        // }
        // echo "</table>\n";

        // var_dump($data);
        // if (count($data) == 0) {

        //     return back()->with('message', 'invalid child id...!');
        // }

        return view('testform', compact('ajaira', 'data'));
    }
}
