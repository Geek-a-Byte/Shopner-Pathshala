<!DOCTYPE html>
<html lang="en">

<head>
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
    <script>
        $(document).ready(function() {
            $(function() {
                $('#datetimepicker').datetimepicker();
                $('#datetimepicker7').datetimepicker({
                    useCurrent: false, //Important! See issue #1075
                    format: 'DD-MMM-YY HH:mm'
                });
                $('#datetimepicker6').datetimepicker({
                    useCurrent: false, //Important! See issue #1075
                    format: 'DD-MMM-YY HH:mm'
                });
                $("#datetimepicker6").on("dp.change", function(e) {
                    $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                });
                $("#datetimepicker7").on("dp.change", function(e) {
                    $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                });
            });
        });
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        hr {
            border: 1px solid black;
            /* border-style: inherit; */
            border-color: rgba(0, 0, 255, 0.25);
        }

        .avatarrow {
            padding: auto;
            margin: 10px;
        }

        .working-hr {
            padding: 10px;
            margin: 10px;
        }

        .navbar-brand {
            margin-top: -40px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="{{URL::asset('/image/whitelogo.png')}}" width="200" height="100" class="d-inline-block align-top" alt="">
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ route('home') }}">Home</a></li>
                        <li class="dropdown">
                            <!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                Hi There <span class="caret"></span>
                            </a> -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('doctor.image.show') }}">
                                        {{ __('Profile') }}
                                    </a></li>
                                @if(Auth::user()->role=="Doctor")
                                <li><a class="dropdown-item" href="{{ route('doctor.view.appointment') }}">
                                        {{ __('Autism Type Define') }}
                                    </a></li>
                                @endif
                                <li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></li>
                            </ul>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                </div>
                </li>
                </ul>
            </div>

    </div>
    </nav>
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php
                $email = Auth::user()->email;
                $user = DB::table('doctors')->where('doctor_email_id', $email)->first();
                ?>
                <div class="card">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                </div>
                <div class="row">

                    <div class="col-md-10 col-md-offset-1">
                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                        <h2>{{ $user->doctor_name }}'s Profile</h2>
                    </div>

                    <form enctype="multipart/form-data" action="/profile" method="POST">
                        <div class="avatarrow">
                            <label>Update Profile Image</label>
                            <input type="file" name="avatar">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                        <div class="avatarrow">
                            <label>Select Working Hour</label>

                            <div class="form-group row">
                                <div class='col-md-5'>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker6'>
                                            <input class="form-control" name="work_hour_from" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <div>
                                            <h5>to</h5>
                                        </div>
                                        <div class='input-group date' id='datetimepicker7'>
                                            <input class="form-control" name="work_hour_to" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="table-responsive">
                            <table class="table">

                                <tbody>
                                    <tr class="success">
                                        <th>Institution ID
                                        <td>{{ $user->doctor_id }}</td>
                                        </th>
                                    </tr>
                                    <tr class="info">
                                        <th>Name
                                        <td>{{ $user->doctor_name }}</td>
                                        </th>
                                    </tr>
                                    <tr class="success">
                                        <th>Email
                                        <td>{{ $user->doctor_email_id }}</td>
                                        </th>
                                    </tr>
                                    <tr class="info">
                                        <th>Gender
                                        <td>{{ $user->doctor_gender }}</td>
                                        </th>
                                    </tr>
                                    <tr class="success">
                                        <th>Designation
                                        <td>{{ $user->doctor_designation }}</td>
                                        </th>
                                    </tr>
                                    <tr class="info">
                                        <th>Working Hour
                                        <td>{{ $user->working_hour_from }} - {{ $user->working_hour_to }}</td>
                                        </th>
                                    </tr>

                                    <tr class="success">
                                        <th>Account Created
                                        <td>{{ $user->created_at }}</td>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="submit" class="pull-right btn btn-sm btn-primary">

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>