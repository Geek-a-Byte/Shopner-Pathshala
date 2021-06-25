<?php


namespace App\Http\Controllers\ScoreUpdate;

use App\Http\Controllers\Controller;
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

        // echo "cid" . $child_id . "</br>";
        // echo "score" . $score . "</br>";
        // echo "tcode" . $test_code . "</br>";

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

        for ($i = 0; $i < count($test_code); ++$i) {

            $save_test_code = $test_code[$i];
            $save_child_id = $child_id[$i];
            $save_score = $score[$i];
            if ($save_score != '') {
                $sql = "BEGIN UPDATE results set score=:score where child_id=:child_id and test_code=:test_code; END;";
                $stmt = oci_parse($conn, $sql);
                oci_bind_by_name($stmt, ':child_id', $save_child_id, 255);
                oci_bind_by_name($stmt, ':test_code', $save_test_code, 255);
                oci_bind_by_name($stmt, ':score', $save_score, 300, 0);
                oci_execute($stmt);
            }
        }

        return redirect()->back()->with('message', 'Score Updated Successfully');
    }
}
