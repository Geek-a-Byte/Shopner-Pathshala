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
        <div class="card">
            @if(session()->has('message'))
            <div class="alert alert-warning">
                {{ session()->get('message') }}
            </div>
            @endif

        </div>

        <form method="post" action="{{ route('teacher.search.result') }}">
            @csrf
            <div class="row">
                <div class="col-25">
                    <label for="childID">Give Child ID</label>
                </div>
                <div class="col-75">
                    <input type="number" id="name" name="child_id">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="form-group">
                    <input type='submit' value='Search For Courses'>
                </div>
            </div>

            <hr>
        </form>
        @isset($data)
        <form method="post" action="{{ route('teacher.appoint.course.store') }}">
            @csrf

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">


                        <div>
                            <label>Child ID</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="child_id" value={{$c_code}} readonly />
                            </div>

                        </div>
                        @if($new_student=="no")
                        <div class="card">

                            <div class="alert alert-success">
                                previous student so all appropriate courses should be appointed
                            </div>


                        </div>
                        <tr>
                            <th>Child ID</th>
                            <th>Standard Course Code</th>
                            <th>Standard Course Score</th>
                            <th>Course Code That Can Be Appointed</th>
                            <th>Action</th>
                            <th>Course_Name</th>
                            <th>Course_Content</th>
                            <th>Course Duration</th>
                            <th>Course_level</th>

                        </tr>
                        @foreach ($data as $d)
                        <tr>
                            @foreach ($d as $k => $v)
                            @if($k=="COURSE_CONTENT")
                            <td>
                                <a href="{{$v}}">Link</a>
                            </td>
                            @else
                            <td>{{$v}}</td>
                            @endif
                            @if($k=="COURSE_THAT_CAN_BE_APPOINTED")
                            <td>
                                <input type="checkbox" class="check" name="selectCourse[]" value={{$v}}></input>
                            </td>
                            @endif

                            @endforeach
                        </tr>
                        @endforeach
                        @else
                        <div class="card">
                            <div class="alert alert-success">
                                new student so all easy courses should be appointed
                            </div>
                        </div>
                        <tr>
                            <th>Action</th>
                            <th>Course Code</th>
                            <th>Course Level</th>
                            <th>Course Name</th>
                            <th>Course Duration</th>
                            <th>Course_Content</th>
                            <th>Prerequisites</th>
                            <th>by Teacher_id</th>
                        </tr>
                        @foreach ($data as $d)
                        <tr>
                            @foreach ($d as $k => $v)
                            @if($k=="COURSE_CODE")
                            <td>
                                <input type="checkbox" class="check" name="selectCourse[]" value={{$v}}></input>
                            </td>
                            <td>{{$v}}</td>
                            @elseif($k=="COURSE_CONTENT")
                            <td>
                                <a href="{{$v}}">Link</a>
                            </td>
                            @else
                            <td>{{$v}}</td>
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                        @endif

                    </table>


                </div>
                <div class="row">
                    <div class="col-25">
                        <input type='submit' value='Appoint Courses'>
                    </div>
                </div>
        </form>
        @endisset
</body>

</html>
@endsection