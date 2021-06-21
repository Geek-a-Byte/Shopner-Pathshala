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


        <form method="post" action="{{ route('teacher.test.code.search') }}">//*m
            @csrf

            <div class="row">
                <div class="col-25">
                    <label for="test_code">Give Test ID</label>
                </div>
                <div class="col-75">
                    <input type="String" id="name" name="test_code">
                </div>
                <div class="form-group">
                    <input type='submit' value='Submit'>
                </div>
            </div>
            </form>
            <form method="post" action="{{ route('teacher.appoint.score.store') }}">//*m
            @csrf
            <div class="row">
                <div class="col-25">
                    <label for="Category">Give Score</label>
                </div>
                <div class="col-75">
                   
                </div>
            </div>

    
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                     
                        <th>Test_Code</th>
                        <th>Child_id</th>
                        <th>Course_code</th>
                        <th>Course_Name</th> 
                        <th>Score</th>
                        
                    </tr>
               


                    @isset($data)
                                    @foreach ($data as $d)
                                    <tr>
                                        @foreach ($d as $k => $v)
                                        <td>{{$v}}</td>
                                       
                                        @endforeach

                                    </tr>
                                    @endforeach
                                   
                                    @endisset



             @isset($data)
                    @foreach ($data as $d)
                    <tr>
                        @foreach ($d as $k => $v)
                        @if($k=="score")
                        <td>
                            <input type="number" name="selectScore[]" >
                        </td>
                        @endif
                        
                        @endforeach

                    </tr>
                    @endforeach
                    @endisset
                </table>
            </div>
            <div class="row">
                <div class="col-25">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Confirm Score') }}
                    </button>
                </div>
            </div>



    </div>

</body>

</html>
@endsection