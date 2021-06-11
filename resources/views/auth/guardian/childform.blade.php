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
        <div class="centerheader">
            <h2>Child Form</h2>

        </div>

        <form method="post" action="{{ route('child.store') }}">
            @csrf
            <div class="row">
                <div class="col-25">
                    <label for="name">Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="child_name" placeholder="Child name..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="name">Father's Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="lname" name="father_name" placeholder="father's name..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="name">Father's Phone Number</label>
                </div>
                <div class="col-75">
                    <input type="number" id="lname" name="father_phone" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">Father's Email ID</label>
                </div>
                <div class="col-75">
                    <input type="email" id="lname" name="father_email" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="name">Mother's Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="lname" name="mother_name" placeholder="mother's name..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="phone">Mother's Phone Number</label>
                </div>
                <div class="col-75">
                    <input type="number" id="lname" name="mother_phone" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">Mother's Email ID</label>
                </div>
                <div class="col-75">
                    <input type="email" id="lname" name="mother_email" placeholder="">
                </div>
            </div>


            <div class="row">
                <div class="col-25">
                    <label for="age">Age</label>
                </div>
                <div class="col-75">
                    <input type="number" id="lname" name="child_age" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="gender">Gender</label>
                </div>
                <div class="col-75">
                    <select id="gender" name="child_gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-25">
                    <label for="subject">Hobby</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="hobby" placeholder="if any.." style="height:100px"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Repeatative Behaviour</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="repeatative_behaviour" placeholder="if any.." style="height:100px"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Eating Habit</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="eating_habit" placeholder="if any.." style="height:100px"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Communication Skill</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="com_skills" placeholder="if any.." style="height:100px"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Special Skill</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="special_skills" placeholder="if any.." style="height:100px"></textarea>
                </div>

            </div>
            <div class="centerheader">
                <div class="col-25">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>

    </div>

</body>

</html>
@endsection