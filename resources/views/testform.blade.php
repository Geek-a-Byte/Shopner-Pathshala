@extends('layouts.auth')

@section('content')

<head>
    <script>
        $(document).ready(function() {
            $('.check').click(function() {
                $('.check').not(this).prop('checked', false);
            });
            $('.release').click(function() {


            });

    </script>
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

<div class="container">

                    <form action="/Test" method="POST">
                        @csrf

                        <label>Give Child ID</label>
                        <div class="form-group row">
                            <div class='col-md-5'>
                                <div class="form-group">
                                        <input class="form-control" type="text" name="child_id">
                                </div>
                                <div class="form-group">
                                        <input type='submit' value='Submit'>
                                </div>
                            </div>
                        </div>

                    </form>


    <form method="POST" action={{'/SearchTest'}}>
        @csrf

        <!-- <div class="row">
            <div class="col-25">
                <label for="Category">Select Test Category</label>
            </div>
            <div class="col-75">
                <select id="category" name="course_category">
                <option value=""> Select Course </option>
                <?php
                    // include public_path('includes/connection.php'); 
                    // $stid = oci_parse($conn, 'SELECT course_code FROM child_takes_course where child_id=:c_code');
                    // oci_bind_by_name($stid, ":c_code",$c_code);
                    // oci_execute($stid);
                    // while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    //     $WID=$row ['COURSE_CODE'];
                    //     echo "<option value='". $WID ."'>" .$WID ."</option>";
                    // }	
                ?>  
                    
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <button type="submit" class="btn btn-primary">
                    {{ __('Search for Tests') }}
                </button>
            </div>
        </div> -->

<hr>
<hr>

                        <div class=" card-header">
                            <h3><b>Select Your Test</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Level</th>
                                        <th>Appointment Status</th>
                                        <th>Action</th>
                                        <th>Test Code</th>
                                        <th>Test Question</th>
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
                                        @if($k=="TEST_CODE")

                                        <td>
                                            <?php
                                            include public_path('includes/connection.php');
                                            $stid = oci_parse($conn, 'SELECT * FROM results where child_id=:ajaira and test_code=:v');
                                            oci_bind_by_name($stid, ":ajaira", $ajaira);
                                            oci_bind_by_name($stid, ":v", $v);
                                            oci_execute($stid);
                                            $data1 = array();
                                            $i = 0;
                                            while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                                $data1[] = $row;
                                                //var_dump($data1);
                                            }
                                            //var_dump($data1);
                                            if (count($data1) == 0) {
                                                $status = "Not Appeared";
                                                echo " Not Appeared\n";
                                            } else {
                                                $status = "booked";
                                                $pass_fail=$data1[0]["SCORE"];
                                                if($pass_fail>=10)
                                                    echo " Passed\n";
                                                else
                                                    echo " Failed\n";
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
                                            @if($status=="Not Appeared")
                                            <input type="checkbox" class="check" name="selectTest" value={{$v}}></input>
                                            @else
                                            <input type="checkbox" class="check" name="selectTest" disabled>
                                            @endif
                                        </td>
                                        @endif

                                        
                                        @endforeach

                                    </tr>
                                    @endforeach
                                     <div>
                                        <label>Child ID</label>
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker'>
                                                <input class="form-control" type="text" name="ajaira" value={{$ajaira}} readonly />

                                                
                                            </div>
                                        </div>

                                    </div>
                                    @endisset
                                </table>


                            </div>

                        </div>
                    <input type="submit" value="Go To Test" class="btn btn-primary">
                    </input>


    </form>

</div>


@endsection