<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Result;
use Illuminate\Http\Request;


class ResultController extends Controller
{
    //
    public function index()
    {
        return view('result');
    }

    public function get_all_results(Request $request)
    {
        // echo $app_time;
        $guardian = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
        $users = DB::table('childs')->where('acct_holder_id', $guardian->acct_holder_id)->get(); //var_dump($guardian);
        // var_dump($users);
        $c_code = $request->child_id;
        $g_id = $guardian->acct_holder_id;
        $data = DB::table('childs')->where('acct_holder_id', $g_id)
            ->where('child_id', $c_code)->value('child_id');
        if (is_null($data)) {
            return back()->with('message', 'invalid child id...!');
        } else {
            return view('result', compact('data'));
        }
    }

    // return view('result')->with('message', 'no results found...!');

}
