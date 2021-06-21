<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class viewAppointmentController extends Controller
{
    //
    public function index()
    {
        return view('viewAppointment');
    }
    public function store(Request $request)
    {
        // return view('createCourse');
        // echo $request->autism_type;
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect('autism.type')
                ->withErrors($validator)
                ->withInput();
        }

        include public_path('includes/connection.php');
        $child_id = $request->child_id;
        $autism_type = $request->autism_type;
        echo $child_id;
        echo $autism_type;
        $sql = "BEGIN UPDATE childs set autism_type=:autism where child_id=:id; END;";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ':autism', $autism_type);
        oci_bind_by_name($stmt, ':id', $child_id);
        oci_execute($stmt);

        // return redirect()->back()->with('message', 'child autism type updates successfully.');
    }
}
