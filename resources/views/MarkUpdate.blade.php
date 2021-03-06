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
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
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
            float: left;

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
            @if(session()->has('message'))
            <div class="alert alert-warning">
                {{ session()->get('message') }}
            </div>
            @endif
        </div>


        <form method="post" action="{{ route('teacher.appoint.course.store') }}">
            @csrf

            <div class="row">
                <div class="col-25">
                    <label for="testID">Give Test ID</label>
                </div>
                <div class="col-75">
                    <input type="text" id="name" name="test_code" placeholder="input the test code">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="Category">Select Courses</label>
                </div>
                <div class="col-75">
                    <?php
                    // $user = DB::table('teachers')->where('user_id', Auth::user()->id)->first();
                    @include public_path('includes/connection.php');
                    $stid = oci_parse($conn, 'SELECT course_code,course_level,course_name,course_duration,course_content,pre_requisite,teacher_id FROM courses');
                    // oci_bind_by_name($stid, ":app_time", $app_time);
                    oci_execute($stid);
                    $data = array();
                    // $i = 0;
                    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        $data[] = $row;
                    }
                    // }
                    // var_dump($data);
                    // if (count($data) == 0) {
                    //     return back()->with('message', 'no doctors found...!');
                    // }

                    ?>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Action</th>
                        <th>Course_Code</th>
                        <th>Course_level</th>
                        <th>Course_Name</th>
                        <th>Duration</th>
                        <th>Course Link</th>
                        <th>Prerequisites</th>
                        <th>Course Created By</th>
                    </tr>
                    @foreach ($data as $d)
                    <tr>
                        @foreach ($d as $k => $v)
                        @if($k=="COURSE_CODE")
                        <td>
                            <input type="checkbox" name="selectCourse[]" value="{{$v}}">
                        </td>
                        @endif
                        <td>{{$v}}</td>
                        @endforeach

                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="row">
                <div class="col-25">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Appoint Course') }}
                    </button>
                </div>
            </div>


        </form>
    </div>


</body>

</html>
@endsection