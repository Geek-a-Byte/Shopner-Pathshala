@extends('layouts.app')

@section('content')
<style>
  hr {
    border: 1px solid black;
    /* border-style: inherit; */
    border-color: rgba(0, 0, 255, 0.25);
  }
</style>

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <?php
      $email = Auth::user()->email;
      $user = DB::table('doctors')->where('doctor_email_id', $email)->first();
      // var_dump(json_encode($user));

      echo $user->doctor_id;
      echo $user->doctor_name;
      ?>
      


    </div>
  </div>
</div>
@endsection