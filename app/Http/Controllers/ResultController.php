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
       $results = \App\Result::all();
       return view('result',['results' => $results]);   
    }
}
