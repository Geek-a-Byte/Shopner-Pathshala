<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use Illuminate\Http\Request;

class AppointScoreController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('giveTestScore'); ///blade er anm
    }
    public function search(Request $request)
    {

        $test_code = $request->test_code;
        // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();
        include public_path('includes/connection.php');
        $sql = "SELECT test_code,child_id,course_code,course_name
        from results
        inner join tests using (test_code)
        inner join courses using (course_code)
         where test_code=:test_code and score is null ";
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':test_code', $test_code);
        oci_execute($stid);
        $data = array();
        $i = 0;
        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $data[] = $row;
        }

        if (count($data) == 0) {
            return back()->with('message', 'no test found...!');
        } else {
            return view('giveTestScore', compact('test_code', 'data')); ///blader nam return kortese

        }
    }
}
