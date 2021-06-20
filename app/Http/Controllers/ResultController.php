<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Result;
use Illuminate\Http\Request;


class ResultController extends Controller
{
    //
    public function get_all_results()
    {
        $results = \App\Models\Result::all();
        $data = array();
        foreach ($results as $row) {
            $data[] = $row;
        }

        return view('result', ['results' => $data]);

        //return view('result')->with('message', 'no results found...!');
    }
}
