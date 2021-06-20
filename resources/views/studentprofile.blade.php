@extends('layouts.auth')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <style>
    .ScriptHeader {
      float: left;
      width: 100%;
      padding: 2em 0;
    }

    .rt-heading {
      margin: 0 auto;
      text-align: center;
    }

    .Scriptcontent {
      line-height: 28px;
    }

    .ScriptHeader h1 {
      /* font-family: "brandon-grotesque", "Brandon Grotesque", "Source Sans Pro", "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif; */
      text-rendering: optimizeLegibility;
      -webkit-font-smoothing: antialiased;
      /* color: #6a4aed; */
      font-size: 35px;
      font-weight: 700;
      margin: 0;
      line-height: normal;

    }

    .ScriptHeader h2 {
      color: #312c8f;
      font-size: 20px;
      font-weight: 400;
      margin: 5px 0 0;
      line-height: normal;

    }

    .ScriptHeader h1 span {
      display: block;
      padding: 0;
      font-size: 22px;
      opacity: 0.7;
      margin-top: 5px;

    }

    .ScriptHeader span {
      display: block;
      padding: 0;
      font-size: 22px;
      opacity: 0.7;
      margin-top: 5px;
    }


    .rt-container {
      margin: 0 auto;
      padding-left: 12px;
      padding-right: 12px;
    }

    .rt-row:before,
    .rt-row:after {
      display: table;
      line-height: 0;
      content: "";
    }

    .rt-row:after {
      clear: both;
    }

    [class^="col-rt-"] {
      box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      -o-box-sizing: border-box;
      -ms-box-sizing: border-box;
      padding: 0 15px;
      min-height: 1px;
      position: relative;
    }


    @media (min-width: 768px) {
      .rt-container {
        width: 750px;
      }

      [class^="col-rt-"] {
        float: left;
        width: 49.9999999999%;
      }

      .col-rt-6,
      .col-rt-12 {
        width: 100%;
      }

    }

    @media (min-width: 1200px) {
      .rt-container {
        width: 1170px;
      }

      .col-rt-1 {
        width: 16.6%;
      }

      .col-rt-2 {
        width: 30.33%;
      }

      .col-rt-3 {
        width: 50%;
      }

      .col-rt-4 {
        width: 67.664%;
      }

      .col-rt-5 {
        width: 83.33%;
      }


    }

    @media only screen and (min-width:240px) and (max-width: 768px) {

      .ScriptTop h1,
      .ScriptTop ul {
        text-align: center;
      }

      .ScriptTop h1 {
        margin-top: 0;
        margin-bottom: 15px;
      }

      .ScriptTop ul {
        margin-top: 12px;
      }

      .ScriptHeader h1,
      .ScriptHeader h2,
      .scriptnav ul {
        text-align: center;
      }

      .scriptnav ul {
        margin-top: 12px;
      }

      #float-right {
        float: none;
      }

    }





    .student-profile .card {
      border-radius: 10px;
    }

    .student-profile .card .card-header .profile_img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      margin: 10px auto;
      border: 10px solid #ccc;
      border-radius: 50%;
    }

    .student-profile .card h3 {
      font-size: 20px;
      font-weight: 700;
    }

    .student-profile .card p {
      font-size: 16px;
      color: #000;
    }

    .student-profile .table th,
    .student-profile .table td {
      font-size: 14px;
      padding: 5px 10px;
      color: #000;
    }
  </style>
</head>

<body>


  <header class="ScriptHeader">
    <div class="rt-container">
      <div class="col-rt-12">
        <?php
        $guardian = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
        $users = DB::table('childs')->where('acct_holder_id', $guardian->acct_holder_id)->get();
        ?>
        <div class="rt-heading">
          <h1>Child's Profile</h1>
          <!-- <p>A responsive student profile page design.</p> -->
        </div>
      </div>
    </div>
  </header>

  <section>
    <div class="rt-container">
      <div class="col-rt-12">
        <div class="Scriptcontent">


          @foreach ($users as $user)
          <!-- Student Profile -->
          <div class="student-profile py-4">
            <div class="container">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card shadow-sm">
                    <div class="card-header bg-transparent text-center">
                      <img class="profile_img" src="/uploads/avatars/{{ $user->profile_photo }}" alt="student dp">
                      <h3>{{$user->child_name}}</h3>
                    </div>
                    <div class="card-body">
                      <p class="mb-0"><strong class="pr-1">Child ID : </strong>{{$user->child_id}}</p>
                      <p class="mb-0"><strong class="pr-1">Age : </strong>{{$user->child_age}}</p>
                      <p class="mb-0"><strong class="pr-1">Gender : </strong>{{$user->child_gender}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                      <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
                    </div>
                    <div class="card-body pt-0">
                      <table class="table table-bordered">
                        <tr class="success">
                          <th width="30%">Father's Name</th>
                          <td width="2%">:</td>
                          <td>{{$user->father_name}}</td>
                        </tr>
                        <tr class="info">
                          <th width="30%">Father's Email ID</th>
                          <td width="2%">:</td>
                          <td>{{$user->father_email}}</td>
                        </tr>
                        <tr class="success">
                          <th width="30%">Father's Phone no.</th>
                          <td width="2%">:</td>
                          <td>{{$user->father_phone_no}}</td>
                        </tr>
                        <tr class="info">
                          <th width="30%">Mother's Name</th>
                          <td width="2%">:</td>
                          <td>{{$user->mother_name}}</td>
                        </tr>
                        <tr class="success">
                          <th width="30%">Mother's Email ID</th>
                          <td width="2%">:</td>
                          <td>{{$user->mother_email}}</td>
                        </tr>
                        <tr class="info">
                          <th width="30%">Mother's Phone no</th>
                          <td width="2%">:</td>
                          <td>{{$user->mother_phone_no}}</td>
                        </tr>
                        <tr class="success">
                          <th width="30%">Communication Skill</th>
                          <td width="2%">:</td>
                          <td>{{$user->communication_skill}}</td>
                        </tr>
                        <tr class="info">
                          <th width="30%">Special Skill</th>
                          <td width="2%">:</td>
                          <td>{{$user->special_skill}}</td>
                        </tr>
                        <tr class="success">
                          <th width="30%">Eating Habit</th>
                          <td width="2%">:</td>
                          <td>{{$user->eating_habit}}</td>
                        </tr>
                        <tr class="info">
                          <th width="30%">Hobby</th>
                          <td width="2%">:</td>
                          <td>{{$user->communication_skill}}</td>
                        </tr>
                        <tr class="success">
                          <th width="30%">Autism Type</th>
                          <td width="2%">:</td>
                          <td>{{$user->autism_type}}</td>
                        </tr>
                        <tr class="info">
                          <th width="30%">Repeatative Behaviour</th>
                          <td width="2%">:</td>
                          <td>{{$user->repeatative_behaviour}}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          @endforeach
          <!-- partial -->

        </div>
      </div>
    </div>
  </section>



  <!-- Analytics -->

</body>

</html>
@endsection