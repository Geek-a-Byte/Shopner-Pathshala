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
            $('.check').click(function() {
                $('.check').not(this).prop('checked', false);
            });
            $('.release').click(function() {


            });


            $(function() {

                $('#datetimepicker').datetimepicker({
                    useCurrent: false, //Important! See issue #1075
                    format: 'DD-MMM-YY HH:mm'
                });
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

        input[type="submit"] {
            padding: 6px;
            border: 1px solid black;
            /* border-style: inherit; */
            border-color: rgba(0, 0, 255, 0.25);
            border-radius: 2px;
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
                    <!-- <a class="navbar-brand" href="#">
            <img src="{{URL::asset('/image/whitelogo.png')}}" width="200" height="100" class="d-inline-block align-top" alt="">
          </a> -->
                </div>
                <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="dropdown">
                            <!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                Hi There <span class="caret"></span>
                            </a> -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li> <a class="dropdown-item" href="{{ route('doctor.image.show') }}">
                                        {{ __('Profile') }}
                                    </a></li>
                                @if(Auth::user()->role=="Guardian")
                                <li> <a class="dropdown-item" href="{{ route('childform') }}">
                                        {{ __('Register Child') }}
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
                <div class="row">


                    <form action="/makeappointment" method="POST">
                        @csrf

                        <label>Find Available Doctors</label>
                        <div class="form-group row">
                            <div class='col-md-5'>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker6'>
                                        <input class="form-control" type="text" name="work_hour_from" />

                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <input type='submit' value='Search'>
                                </div>
                            </div>
                        </div>

                    </form>


                    <form method="post" action="{{'/bookedappointment'}}">
                        @csrf
                        <div class=" card-header">
                            <h3><b>Doctor Schedule List</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>


                                        <th>Doctor Name</th>
                                        <th>Doctor Email ID</th>
                                        <th>Designation</th>
                                        <th>Doctor ID</th>
                                        <th>Appointment Status</th>
                                        <th>Action</th>


                                    </tr>

                                    <div>
                                        @if(session()->has('message'))
                                        <div class="alert alert-warning">
                                            {{ session()->get('message') }}
                                        </div>
                                        @endif
                                    </div>

                                    @isset($data)
                                    @foreach ($data as $d)
                                    <tr>


                                        @foreach ($d as $k => $v)
                                        <td>{{$v}}</td>
                                        @if($k=="DOCTOR_ID")
                                        <!-- <td><input type="checkbox" class="check" name="selectdoctor" value={{$v}}></td> -->
                                        <td>
                                            <?php
                                            include public_path('includes/connection.php');
                                            $stid = oci_parse($conn, 'SELECT * FROM doctor_guardian where appointment_time=:app_time and doctor_id=:v');
                                            oci_bind_by_name($stid, ":app_time", $app_time);
                                            oci_bind_by_name($stid, ":v", $v);
                                            oci_execute($stid);
                                            $data = array();
                                            $i = 0;
                                            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                                $data[] = $row;
                                            }
                                            if (count($data) == 0) {
                                                $status = "free";
                                                echo " available\n";
                                            } else {
                                                $status = "booked";
                                                echo " booked\n";
                                            }

                                            // var_dump($data);
                                            // echo "<table border='1'>\n";
                                            // while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                            //     echo "<tr>\n";
                                            //     foreach ($row as $item) {
                                            //         echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                                            //     }
                                            //     echo "</tr>\n";
                                            // }
                                            // echo "</table>\n";

                                            //                                             // var_dump($data);
                                            ?>

                                        </td>
                                        <td>
                                            @if($status=="free")
                                            <input type="checkbox" class="check" name="selectdoctor" value={{$v}}></input>
                                            @else
                                            <input type="checkbox" class="check" name="selectdoctor" disabled>
                                            @endif
                                        </td>
                                        @endif

                                        @endforeach

                                    </tr>
                                    @endforeach
                                    <div>
                                        <label>Date of the Appointment</label>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker'>
                                                <input class="form-control" type="text" name="app_time" value={{$app_time}} readonly />

                                                <!-- <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span> -->
                                            </div>
                                        </div>

                                    </div>
                                    @endisset
                                </table>


                            </div>

                        </div>
                        <input type="submit" value="Book Appointment" class="btn btn-primary">
                        </input>
                    </form>


                </div>
            </div>
        </div>
    </div>

</body>