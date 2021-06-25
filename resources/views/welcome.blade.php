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
            background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
        }

        .image-body {

            width: 100%;
            /* border-radius: 15px;
            /* border: 2px solid transparent; */

            display: flex;
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

        #myCarousel {
            height: 550px;

        }

        .carousel-inner img {
            width: 50%;
            margin: auto;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>


<body class="antialiased">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">

            <div class="item active">
                <img src="{{URL::asset('/image/logo.png')}}" alt="Los Angeles" style="width:auto; height:550px;   justify-content: center; align-items: center;">
            </div>

            <div class="item">
                <img src="{{URL::asset('/image/autism.jpeg')}}" alt="Chicago" style="width:auto;height:550px;   justify-content: center; align-items: center;">
            </div>

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- <div class="center">
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

            </div>
            <div class="teacher">
                <center style="padding:5px;">Meet Our Teachers</center>
                <div>
                    <center>
                        <div class="user-image">
                            <img src="{{URL::asset('/image/teacher.png')}}" alt="logo" height="130" width="130">

                        </div>
                    </center>
                </div>

            </div>
            <div class="guardian">
                <center style="padding:5px;">Meet Our Guardians</center>
                <div>
                    <center>
                        <div class="user-image">
                            <img src="{{URL::asset('/image/mother-and-kid.png')}}" alt="logo" height="130" width="130">

                        </div>
                    </center>
                </div>

            </div>
            <div class="nurse">
                <center style="padding:5px;">Meet Our Nurses</center>
                <div>
                    <center>
                        <div class="user-image">
                            <img src="{{URL::asset('/image/nurse.png')}}" alt="logo" height="130" width="130">

                        </div>
                    </center>
                </div>

            </div>
        </div>
    </div> -->

</body>

</html>
@endsection