<?php
$post_id = $post->id;
$comments = $post->comments;
?>
@foreach($comments as $comment)
<div class="display-comment">
    <strong>{{ $comment->user_id }}</strong>
    <p>{{ $comment->comment }}</p>
    <a href="" id="reply"></a>
    <form method="post" action="{{ route('reply.add') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="comment" class="form-control" />
            <input type="hidden" name="post_id" value="{{ $post->id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
        </div>
    </form>
    <?php
    $replies = $comment->replies;
    ?>
    <div class="display-replies">
        @foreach($replies as $reply)
        <strong>{{ $reply->user_id }}</strong>
        <p>{{ $reply->comment }}</p>
        @endforeach
    </div>
</div>
@endforeach