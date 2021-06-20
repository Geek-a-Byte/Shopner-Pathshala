@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3><b>Create Post</b></h3>
                </div>
                <div class="card-body">

                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <form method="post" action="{{ route('post.store') }}">
                        <div class="form-group">
                            @csrf
                            <h5>Post Title: </h5>
                            <input type="text" name="title" class="form-control" required />
                        </div>
                        <div class="form-group">
                            @csrf
                            <h5>Post Body: </h5>
                            <textarea name="body" rows="10" cols="30" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Create post" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection