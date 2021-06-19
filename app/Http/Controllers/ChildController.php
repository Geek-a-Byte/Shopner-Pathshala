<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Validator;
use App\Models\Child;
use App\Models\Guardian;
use Auth;
use DB;
use Illuminate\Http\Request;


class ChildController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function childcreate()
    {
        return view('auth.guardian.childform');
    }
    public function Chartjs()
    {
        $month = array('Jan', 'Feb', 'Mar', 'Apr', 'May');
        $data  = array(1, 2, 3, 4, 5);
        return view('chartjs', ['Months' => $month, 'Data' => $data]);
    }
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {

            return redirect('registerChild')
                ->withErrors($validator)
                ->withInput();
        }


        $child = new Child;
        $child->user()->associate($request->user());
        $child->child_name = $request->child_name;
        $child->father_name = $request->father_name;
        $child->mother_name = $request->mother_name;
        $child->mother_email = $request->mother_email;
        $child->father_email = $request->father_email;
        $child->father_phone_no = $request->father_phone;
        $child->mother_phone_no = $request->mother_phone;
        $child->child_age = $request->child_age;
        $child->child_gender = $request->child_gender;
        $child->hobby = $request->hobby;
        $child->repeatative_behaviour = $request->repeatative_behaviour;
        $child->eating_habit = $request->eating_habit;
        $child->communication_skill = $request->com_skills;
        $child->special_skill = $request->special_skills;
        $user = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
        $child->acct_holder_id = $user->acct_holder_id;
        $child_guardian = Guardian::find($user->acct_holder_id);
        $child_guardian->childs()->save($child);
        $child->save();


        return redirect()->back();
    }
}
