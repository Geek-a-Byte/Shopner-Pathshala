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
        return view('giveTestScore');   //*m
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), []);
        if ($validator->fails()) {
            return redirect('teacher.appoint.score') //* m
                ->withErrors($validator)
                ->withInput();
        }
        // var_dump($request->selectCourse);
        var_dump($request->test_code);//*m
        include public_path('includes/connection.php');
        $checkbox1 = $request->selectScore; //*M
        // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();

        for ($i = 0; $i < count($checkbox1); $i++) {
            $check_id = $checkbox1[$i];
            $sql = 'insert into results (score) values(:score)';//*m
            $stmt = oci_parse($conn, $sql);
            //oci_bind_by_name($stmt, ':child_id', $child_id, 255);//*m
            oci_bind_by_name($stmt, ':score', $check_id, 255);//*m
            $test_code = $request->test_code;//*m
            oci_execute($stmt);
        }
        return redirect()->back()->with('message', 'Score Appointed Successfully');//*m
    }
}
