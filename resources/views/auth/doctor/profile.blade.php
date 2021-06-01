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
      @auth('doctor')
      <img src="/uploads/avatars/{{Auth::guard('doctor')->user()->profile_photo}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
      <h2>{{ Auth::guard('doctor')->user()->doctor_name }}'s Profile</h2>
      <form enctype="multipart/form-data" action="/profile" method="POST">
        <label>Update Profile Image</label>
        <input type="file" name="profile_photo">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="pull-right btn btn-sm btn-primary">
      </form>

      <div class="card-body">

        <div class="row">
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h5 class="mb-0"><b>Doctor ID</b></h5>
          </div>
          <div class="col-sm-9 text-secondary">
            <h5> {{ Auth::guard('doctor')->user()->doctor_id }}</h5>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h5 class="mb-0"><b>Name</b></h5>
          </div>
          <div class="col-sm-9 text-secondary">
            <h5>{{ Auth::guard('doctor')->user()->doctor_name }}</h5>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h5 class="mb-0"><b>Email</b></h5>
          </div>
          <div class="col-sm-9 text-secondary">
            <h5>{{ Auth::guard('doctor')->user()->doctor_email_id }}</h5>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h5 class="mb-0"><b>Gender</b></h5>
          </div>
          <div class="col-sm-9 text-secondary">
            <h5>{{ Auth::guard('doctor')->user()->doctor_gender }}</h5>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h5 class="mb-0"><b>Address</b></h5>
          </div>
          <div class="col-sm-9 text-secondary">
            <h5>{{ Auth::guard('doctor')->user()->doctor_address }}</h5>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h5 class="mb-0"><b>Designation</b></h5>
          </div>
          <div class="col-sm-9 text-secondary">
            <h5>{{ Auth::guard('doctor')->user()->doctor_designation }}</h5>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
          </div>
        </div>
      </div>
      @endauth

    </div>
  </div>
</div>
@endsection