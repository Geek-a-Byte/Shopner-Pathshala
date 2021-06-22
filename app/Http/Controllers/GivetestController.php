<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Auth;

class GivetestController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        //var_dump($request->test_code);
        $validator = Validator::make($request->all(), []);
        if ($validator->fails()) {
            return redirect('search.course')
                ->withErrors($validator)
                ->withInput();
        }
        include public_path('includes/connection.php');
        $checkbox1 = $request->selectTest;
        $ajaira = $request->ajaira;
        // var_dump($checkbox1);
        // var_dump($request->child_id);
        // $ajaira=$request->child_id;
        //echo $ajaira;
        // var_dump($ajaira);

        // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();


        $check_id = $checkbox1;
        $sql = 'BEGIN insert into results (child_id,test_code) values(:ajaira,:test_code); END;';
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':ajaira', $ajaira);
        oci_bind_by_name($stmt, ':test_code', $check_id);
        oci_execute($stmt);

        $sql = 'SELECT test_question from tests where test_code=:test_code';
        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':test_code', $check_id);
        oci_execute($stid);

        $testdata = array();
        $i = 0;
        while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $testdata[] = $row;
        }
        if (count($testdata) == 0) {
            return back()->with('message', 'no test question found...!');
        } else {
            return view('testform', compact('testdata'));
        }
    }
}
