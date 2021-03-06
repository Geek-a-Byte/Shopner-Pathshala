@extends('layouts.auth')

@section('content')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        input[type=text],
        input[type=textarea],
        input[type=number],
        input[type=email],
        input[type=phone],
        select,
        textarea {
            width: 50%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            float: left;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;

        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 50px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .centerheader {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {

            .col-25,
            .col-75,
            input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>

</head>

<body>
    <div class="container">
        <div>
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-25">
                <label for="Category">View Appointments</label>
            </div>
            <div class="col-75">
            </div>
        </div>
        <?php
        $doctor = DB::table('doctors')->where('user_id', Auth::user()->id)->first();
        $appoint_info = DB::table('doctor_guardian')
            ->join('childs', 'childs.child_id', '=', 'doctor_guardian.child_id')
            ->select('doctor_guardian.appointment_id', 'doctor_guardian.acct_holder_id', 'doctor_guardian.child_id', 'doctor_guardian.appointment_time', 'doctor_guardian.appointment_end_time', 'childs.autism_type', 'doctor_guardian.prescription')
            ->where('doctor_id', $doctor->doctor_id)
            // ->whereNULL('prescription')
            // ->orWhereNULL('autism_type')
            ->get();

        ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Appointment ID</th>
                    <th>Guardian ID</th>
                    <th>Child ID</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Autism Type</th>
                    <th>Prescription</th>
                    <th>Action</th>
                </tr>
                @foreach ($appoint_info as $row)
                <tr>
                    <form method="POST" action="{{route('autism.type')}}">
                        @csrf
                        @foreach ($row as $k=>$v)
                        @if($k=='appointment_id')
                        <?php $app_id = $v; ?>
                        <td style="width:5%;"><input class='form-control' name='appointment_id' value={{$v}} readonly></td>
                        @elseif($k=='child_id')
                        <?php $child_id = $v; ?>
                        <td style="width:5%;"><input class='form-control' name='child_id' value={{$child_id}} readonly></td>
                        @elseif($k=='autism_type')
                        <?php
                        $autism_type_define_or_not
                            = DB::table('childs')
                            ->select('autism_type')
                            ->where('child_id', $child_id)
                            ->first();

                        ?>
                        <div class="form-group flex">
                            @if($autism_type_define_or_not->autism_type!='')
                            <td style="width:25%;">Already Defined as {{$autism_type_define_or_not->autism_type}}</td>
                            @elseif($autism_type_define_or_not->autism_type=='')
                            <td style="width:25%;"><input class=" form-control" type="text" name='autism_type'></input></td>
                            @endif
                        </div>
                        @elseif($k=='prescription')
                        <?php
                        $pres
                            = DB::table('doctor_guardian')
                            ->select('prescription')
                            ->where('child_id', $child_id)
                            ->where('appointment_id', $app_id)
                            ->first();

                        ?>
                        <div class="form-group flex">
                            @if($pres->prescription!='')
                            <td style="width:25%;"><a href="{{$pres->prescription}}" target="_blank">prescription already given</a></td>
                            @elseif($pres->prescription=='')
                            <td style="width:25%;"><input class=" form-control" type="text" name='prescription'></input></td>
                            @endif
                        </div>
                        <td><input type='submit' value='Submit'></td>
                        @else
                        <td>{{$v}}</td>
                        @endif
                        @endforeach
                    </form>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div>
    </div>
</body>


</html>
@endsection