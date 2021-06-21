<?php

namespace App\Http\Controllers;

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
    public function get_all_results()
    {
        $results = \App\Models\Result::all();
        $data_for_pie = array();
        foreach ($results as $row) {
            $data_for_pie[] = $row;
        }
        // var_dump($data);
        return view('result', compact('data_for_pie'));

        // return view('result')->with('message', 'no results found...!');
    }
}
