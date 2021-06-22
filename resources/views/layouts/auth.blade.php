<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopner Pathshala</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->
    <title>{{ config('app.name', 'Shopner Pathshala') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        image {
            background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);
        }

        body {
            /* background-image: linear-gradient(to right, #6a11cb 0%, #2575fc 100%); */
        }

        .user-image {
            text-align: center;
            padding: 10px;
        }

        .navbar-brand {
            margin-top: -40px;
        }
    </style>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
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
                                @if(Auth::user()->role=="Guardian")
                                <li><a class="dropdown-item" href="{{ route('childform') }}">
                                        {{ __('Register Child') }}
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('studentprofile') }}">
                                        {{ __('View Child Profile') }}
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('student.view.course') }}">
                                        {{ __('View Courses') }}
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('child.test') }}">
                                        {{ __('Give test') }}
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('result.graph') }}">
                                        {{ __('View Results') }}
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('post.create') }}">
                                        {{ __('Create Post') }}
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('makeappointment') }}">
                                        {{ __('Book An Appointment') }}
                                    </a></li>
                                @endif
                                @if(Auth::user()->role=="Teacher")
                                <li> <a class="dropdown-item" href="{{ route('teacher.test.code') }}">
                                        {{ __('Update Test Marks') }}
                                    </a></li>
                                <li> <a class="dropdown-item" href="{{ route('teacher.create.course') }}">
                                        {{ __('Create Course and Test Content') }}
                                    </a></li>
                                <li> <a class="dropdown-item" href="{{ route('teacher.appoint.course') }}">
                                        {{ __('Appoint Course') }}
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
                <!-- <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul> -->
            </div>

    </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>