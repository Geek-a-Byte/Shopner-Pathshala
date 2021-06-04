@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shopner Pathshala</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        /* Navbar container */
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }


        image {
            background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);
        }

        body {
            background-image: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        }

        .image-body {
            background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
            width: 100%;
            /* border-radius: 15px; */
            /* border: 2px solid transparent; */
            justify-content: center;
            align-items: center;
        }

        .register-options {
            display: flex;
            flex-wrap: wrap;
            margin: 20px;
            justify-content: center;
            align-items: center;
        }

        .login-registerBTN {
            display: flex;
            flex-direction: column;
        }


        .login-registerBTN a {
            color: black;
            font-family: 'Roboto', sans-serif;
        }



        .doctor,
        .teacher,
        .nurse,
        .guardian {
            margin: 30px;
            padding: 30px;
            border-radius: 15px;
            border: 2px solid transparent;
            height: auto;
            text-align: center;
            background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
        }

        button {
            margin: 10px;
            border-radius: 10px;
            border: 2px solid transparent;
            width: 100px;
            height: 30px;
            text-align: center;
            background-image: linear-gradient(120deg, #a18cd1 0%, #fbc2eb 100%);
        }

        .user-image {
            text-align: center;
            padding: 10px;
        }

        .navbar-brand {
            margin-top: -40px;
        }



        /* Responsive layout - makes a one column layout instead of a two-column layout */
        @media (max-width: 800px) {
            .register-options {
                flex-direction: column;
            }
        }
    </style>

</head>


<body class="antialiased">


    <div class="image-body">
        <center>
            <img src="{{URL::asset('/image/logo.png')}}" alt="logo" height="200" width="400">
        </center>
    </div>
    <div class="center">
        <div class="register-options">
            <div class="doctor">
                <center style="padding:5px;">Meet Our Doctors</center>
                <div>
                    <center>
                        <div class="user-image">
                            <img src="{{URL::asset('/image/doctor.png')}}" alt="logo" height="130" width="130">
                        </div>
                    </center>
                </div>
                <!-- <div class="login-registerBTN">
                    <a href="{{ route('doctorRegister') }}">
                        <button>Register</button>
                    </a>
                    <a href="{{ route('doctorLogin') }}">
                        <button>Login</button>
                    </a>
                </div> -->
            </div>
            <div class="teacher">
                <center style="padding:5px;">Meet Our Teachers</center>
                <div>
                    <center>
                        <div class="user-image">
                            <img src="{{URL::asset('/image/teacher.png')}}" alt="logo" height="130" width="130">
                            <!-- <center style="padding:5px;">Teacher Register</center> -->
                        </div>
                    </center>
                </div>
                <!-- <div class="login-registerBTN">
                    <a href="{{ route('teacherRegister') }}">
                        <button>Register</button>
                    </a>
                    <a href="{{ route('teacherLogin') }}">
                        <button>Login</button>
                    </a>
                </div> -->
            </div>
            <div class="guardian">
                <center style="padding:5px;">Meet Our Guardians</center>
                <div>
                    <center>
                        <div class="user-image">
                            <img src="{{URL::asset('/image/mother-and-kid.png')}}" alt="logo" height="130" width="130">
                            <!-- <center style="padding:5px;">Teacher Register</center> -->
                        </div>
                    </center>
                </div>
                <!-- <div class="login-registerBTN">
                    <a href="{{ route('guardianRegister') }}">
                        <button>Register</button>
                    </a>
                    <a href="{{ route('guardianLogin') }}">
                        <button>Login</button>
                    </a>
                </div> -->
            </div>
            <div class="nurse">
                <center style="padding:5px;">Meet Our Nurses</center>
                <div>
                    <center>
                        <div class="user-image">
                            <img src="{{URL::asset('/image/nurse.png')}}" alt="logo" height="130" width="130">
                            <!-- <center style="padding:5px;">Teacher Register</center> -->
                        </div>
                    </center>
                </div>
                <!-- <div class="login-registerBTN">
                    <a href="{{ route('nurseRegister') }}">
                        <button>Register</button>
                    </a>
                    <a href="{{ route('nurseLogin') }}">
                        <button>Login</button>
                    </a>
                </div> -->
            </div>
        </div>
    </div>

</body>

</html>
@endsection