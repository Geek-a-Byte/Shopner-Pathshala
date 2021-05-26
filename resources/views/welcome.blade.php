<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        /* Navbar container */
        * {
            margin: 0;
            padding: 0;
        }


        image {
            background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            font-family: Arial;

        }

        /* Links inside the navbar */
        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* The dropdown container */
        .dropdown {
            float: left;
            overflow: hidden;
        }

        /* Dropdown button */
        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            /* Important for vertical align on mobile phones */
            margin: 0;
            /* Important for vertical align on mobile phones */
        }

        /* Add a red background color to navbar links on hover */
        .navbar a:hover,
        .dropdown:hover .dropbtn {
            background-color: red;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        /* Add a grey background color to dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }


        body {
            font-family: 'Nunito', sans-serif;

        }

        .image-body {
            background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
            width: 100%;
        }

        .register-options {
            display: flex;
            margin: auto;
        }

        .center {
            margin: auto;
            width: 80%;
            /* border: 3px solid green; */
            padding: 10px;
        }

        .doctor,
        .teacher,
        .nurse,
        .guardian {
            margin: 40px;
            padding: 20px;
            border-radius: 15px;
            border: 2px solid transparent;
            width: 200px;
            height: 300px;
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
        }
    </style>

</head>


<body class="antialiased">
    <!-- <div>
        @if (Route::has('login'))
        <div class="navbar">
            @auth
            <a href="{{ url('home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
            <div class="dropdown">
                <button class="dropbtn">Login
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 underline">User Login</a>
                    <a href="{{ route('adminLogin') }}" class="ml-4 text-sm text-gray-700 underline">Admin Login</a>
                    <a href="{{ route('writerLogin') }}" class="ml-4 text-sm text-gray-700 underline">Admin Login</a>
                    @endif
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">Register
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">User Registration</a>
                    <a href="{{ route('adminRegister') }}" class="ml-4 text-sm text-gray-700 underline">Admin Registration</a>
                    <a href="{{ route('writerRegister') }}" class="ml-4 text-sm text-gray-700 underline">Admin Registration</a>
                    @endif

                </div>


                @endauth
            </div>
            @endif

        </div>
    </div> -->

    <div class="image-body">
        <center>
            <img src="{{URL::asset('/image/logo.png')}}" alt="logo" height="200" width="400">
        </center>
    </div>
    <div class="center">
        <div class="register-options">
            <div class="doctor">
                <center style="padding:5px;">Doctor</center>
                <div class="user-image">
                    <center>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">
                            <img src="{{URL::asset('/image/doctor.png')}}" alt="logo" height="130" width="130">
                        </a>
                    </center>
                </div>
                <div>
                    <button class="doctorRegisterBtn">
                        Register
                    </button>
                    <button class="doctorLoginBtn">
                        Login
                    </button>
                </div>
            </div>
            <div class="teacher">
                <center style="padding:5px;">Teacher</center>
                <div>
                    <center>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">
                            <img src="{{URL::asset('/image/teacher.png')}}" alt="logo" height="130" width="130">
                            <!-- <center style="padding:5px;">Teacher Register</center> -->
                        </a>
                    </center>
                </div>

                <div>
                    <button class="doctorRegisterBtn">
                        Register
                    </button>
                    <button class="doctorLoginBtn">
                        Login
                    </button>
                </div>
            </div>
            <div class="guardian">
                <center style="padding:5px;">Guardian</center>
                <div>
                    <center>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">
                            <img src="{{URL::asset('/image/mother-and-kid.png')}}" alt="logo" height="130" width="130">
                            <!-- <center style="padding:5px;">Guardian and Child Register</center> -->
                        </a>
                    </center>
                </div>
                <div>
                    <button class="doctorRegisterBtn">
                        Register
                    </button>
                    <button class="doctorLoginBtn">
                        Login
                    </button>
                </div>
            </div>
            <div class="nurse">
                <center style="padding:5px;">Nurse</center>
                <div>
                    <center>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">
                            <img src="{{URL::asset('/image/nurse.png')}}" alt="logo" height="130" width="130">
                            <!-- <center style="padding:5px;">Nurse Register</center> -->
                        </a>
                    </center>
                </div>

                <div>
                    <button class="doctorRegisterBtn">
                        Register
                    </button>
                    <button class="doctorLoginBtn">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>