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
            @endauth

        </div>
    </div>
</div>
@endsection