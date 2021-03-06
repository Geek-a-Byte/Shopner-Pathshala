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
        <form>
            @csrf
            <div class="row">
                <div class="col-25">
                    <label for="Category">View Courses</label>
                </div>
                <div class="col-75">
                </div>
            </div>
            <?php
            $guardian = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
            $childs = DB::table('childs')->where('acct_holder_id', $guardian->acct_holder_id)->get();

            ?>
            @foreach ($childs as $child)
            <?php
            $data = array();
            $id = $child->child_id;

            $info = DB::table('courses')
                ->join('child_takes_course', 'courses.course_code', '=', 'child_takes_course.course_code')
                ->join('teachers', 'courses.teacher_id', '=', 'teachers.teacher_id')
                ->join('childs', 'child_takes_course.child_id', '=', 'childs.child_id')
                ->select('courses.course_code', 'courses.course_level', 'courses.course_name', 'courses.course_duration', 'courses.course_content', 'courses.pre_requisite', 'teachers.teacher_name')
                ->where('childs.child_id', '=', $id)
                ->get()->toArray();
            $data[] = $info;
            ?>
            <h5><?php echo $id ?></h5>
            <h5><?php echo $child->child_name ?></h5>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Course_Code</th>
                        <th>Course_level</th>
                        <th>Course_Name</th>
                        <th>Duration</th>
                        <th>Course Link</th>
                        <th>Prerequisites</th>
                        <th>Course Created By</th>
                    </tr>
                    @isset($data)
                    @foreach ($data as $row)
                    @foreach ($row as $k)
                    <tr>
                        @foreach ($k as $key => $v)
                        <td>{{$v}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                    @endforeach
                    @endisset
                </table>
            </div>
            @endforeach

        </form>
    </div>


</body>

</html>
@endsection