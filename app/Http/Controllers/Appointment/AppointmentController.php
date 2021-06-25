<?php


namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function appointmentcreate()
    {
        return view('makeappointment');
    }
    public function search(Request $request)
    {
        $now = new DateTime();
        $now = $now->format('d-M-y H:i');
        $app_time = $request->work_hour_from;
        if (strtotime($app_time) < strtotime($now)) {
            return redirect()->back()->with('message', 'Date is in the past');
        } else {
            include public_path('includes/connection.php');
            $stid = oci_parse($conn, 'SELECT doctor_name,doctor_email_id,doctor_designation,doctor_id FROM doctors where working_hour_from<=:app_time and working_hour_to>=:app_time and doctor_id not in (SELECT doctor_id from doctor_guardian where appointment_time<=:app_time and appointment_end_time>=:app_time)');
            oci_bind_by_name($stid, ":app_time", $app_time);
            oci_execute($stid);
            $data = array();
            $i = 0;
            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                $data[] = $row;
            }
            if (count($data) == 0) {

                return back()->with('message', 'no doctors found...!');
            }
            $minutes_to_add = 30;
            $stamp = new DateTime($app_time);
            $stamp->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $stamp = $stamp->format('d-M-y H:i');
            return view('makeappointment', compact('stamp', 'app_time', 'data'));
        }
    }
}
