<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class giveTestScoreController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('giveTestScore');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), []);
        if ($validator->fails()) {
            return redirect('teacher.appoint.score') //* m
                ->withErrors($validator)
                ->withInput();
        }

        include public_path('includes/connection.php');

        $child_id = $request->child_id;
        $score = $request->score;
        $test_code = $request->test_code;
        $sql = "BEGIN UPDATE results set score=:score where child_id=:child_id and test_code=:test_code; END;";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':child_id', $child_id, 255);
        oci_bind_by_name($stmt, ':test_code', $test_code, 255);
        oci_bind_by_name($stmt, ':score', $score, 300, 0);
        oci_execute($stmt);

        return redirect()->back()->with('message', 'Score Updated Successfully');
    }
}
