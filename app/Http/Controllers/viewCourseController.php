<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Child;


class ViewCourseController extends Controller
{
    //
    public function index()
    {
        return view('viewCourse');
    }

    public function view_all_course()
    {

        // echo "<table border='1'>\n";
        // while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        //     echo "<tr>\n";
        //     foreach ($row as $item) {
        //         echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        //     }
        //     echo "</tr>\n";
        // }
        // echo "</table>\n";

        // var_dump($data);
        // if (count($data) == 0) {

        //     return back()->with('message', 'no child found...!');
        // }

        // return view('viewcourse', compact('child', 'data'));
    }
}
