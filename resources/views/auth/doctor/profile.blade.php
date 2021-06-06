@extends('layouts.auth')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    hr {
      border: 1px solid black;
      /* border-style: inherit; */
      border-color: rgba(0, 0, 255, 0.25);
    }
  </style>


</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <?php
        $email = Auth::user()->email;
        $user = DB::table('doctors')->where('doctor_email_id', $email)->first();
        // var_dump(json_encode($user));

        // echo $user->doctor_id;
        // echo $user->doctor_name;

        ?>


        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->doctor_name }}'s Profile</h2>
            <form enctype="multipart/form-data" action="/profile" method="POST">
              <label>Update Profile Image</label>
              <input type="file" name="avatar">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
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
                <td>{{ $user->doctor_working_hour }}</td>
                </th>
              </tr>
              <tr class="success">
                <th>Account Created
                <td>{{ $user->created_at }}</td>
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
@endsection