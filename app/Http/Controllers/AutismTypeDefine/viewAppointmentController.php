<?php

namespace App\Http\Controllers\AutismTypeDefine;

use App\Http\Controllers\Controller;

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
        $app_id = $request->appointment_id;
        $pres = $request->prescription;
        var_dump($autism_type);

        if ($autism_type != '') {
            $sql = "UPDATE childs set autism_type=:autism where child_id=:id and child_id in (select child_id from doctor_guardian where appointment_id=:app_id)";
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ':autism', $autism_type);
            oci_bind_by_name($stmt, ':id', $child_id);
            oci_bind_by_name($stmt, ':app_id', $app_id);
            oci_execute($stmt);
        }

        if ($pres != '') {
            $sql = "BEGIN UPDATE doctor_guardian set prescription=:pres where child_id=:id and appointment_id=:app_id; END;";
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ':pres', $pres);
            oci_bind_by_name($stmt, ':id', $child_id);
            oci_bind_by_name($stmt, ':app_id', $app_id);
            oci_execute($stmt);
        }
        return redirect()->back()->with('success', 'Data updated.');
    }
}
