@extends('layouts.auth')

@section('content')

<head>
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
    <form method="post" action="{{ route('teacher.create.course.store') }}">
        @csrf

        <div class="row">
            <div class="col-25">
                <label for="Category">Select Test Category</label>
            </div>
            <div class="col-75">
                <select id="category" name="course_category">
                    <option value="writing">Writing</option>
                    <option value="emotion">Emotion</option>
                    <option value="math">Math</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <button type="submit" class="btn btn-primary">
                    {{ __('Search for Tests') }}
                </button>
            </div>
        </div>


    </form>

</div>


@endsection