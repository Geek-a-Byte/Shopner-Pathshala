<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewCoursesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('viewCourse');
    }
    public function store()
    {
        // return view('appointCourse');
    }
}
