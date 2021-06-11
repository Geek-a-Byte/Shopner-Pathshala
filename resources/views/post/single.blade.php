@extends('layouts.app')
<style>
    .display-comment {
        background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
        padding: 15px;
        border-radius: 5px;
        border: 2px solid transparent;
        height: auto;
        margin-bottom: 5px;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p>{{ $post->title }}</p>
                    <p>{{ $post->body}}
                    </p>
                </div>

                <div class="card-body">
                    <h5>Display Comments</h5>

                    @include('layouts.replies', ['comments' => $post->comments, 'post_id' => $post->id])


                    <hr />
                </div>

                <div class="card-body">
                    <h5>Leave a comment</h5>
                    <form method="post" action="{{ route('comment.add') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="comment" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                      
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection