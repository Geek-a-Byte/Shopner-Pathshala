@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <th>No</th>
                    <th>Title</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $posts = DB::table('posts')->get();
                    // var_dump($posts);
                    ?>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a href="{{ route('post.show',$post->slug) }}" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">Read Post</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection