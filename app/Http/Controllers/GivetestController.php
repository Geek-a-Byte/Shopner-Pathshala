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
        var_dump($checkbox1);
        var_dump($request->child_id);
        // $ajaira=$request->child_id;
        //echo $ajaira;
        // var_dump($ajaira);

        // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();

            
            $check_id = $checkbox1;
            $score = 0;
            $sql = 'BEGIN insert into results (child_id,test_code,score) values(:ajaira,:test_code,:score); END;';
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ':ajaira', $ajaira);
            oci_bind_by_name($stmt, ':test_code', $check_id);
            oci_bind_by_name($stmt, ':score', $score);
            oci_execute($stmt);
        return redirect()->back()->with('message', 'Course Appointed Successfully');
    }

}
