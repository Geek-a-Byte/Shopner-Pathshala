@extends('layouts.app')

@section('content')
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
                    <div class="col-sm-3">
                      <h5 class="mb-0">Doctor ID</h5>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::guard('doctor')->user()->doctor_id }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h4 class="mb-0">Name</h4>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h4>{{ Auth::guard('doctor')->user()->doctor_name }}</h4>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h4 class="mb-0">Email</h4>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h4>{{ Auth::guard('doctor')->user()->doctor_email_id }}</h4>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h4 class="mb-0">Gender</h4>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h4>{{ Auth::guard('doctor')->user()->doctor_gender }}</h4>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h4 class="mb-0">Address</h4>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h4>{{ Auth::guard('doctor')->user()->doctor_address }}</h4>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h4 class="mb-0">Designation</h4>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h4>{{ Auth::guard('doctor')->user()->doctor_designation }}</h4>
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