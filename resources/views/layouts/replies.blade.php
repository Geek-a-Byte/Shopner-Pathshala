<style>
    .space {
        margin-left: 25px;
    }

    .display-replies {
        padding-top: 15px;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 0px;
        border-radius: 5px;
        background-color: paleturquoise;
        height: auto;
        margin-bottom: 2px;

    }

    p {
        display: flex;
    }
</style>
<?php
$post_id = $post->id;
$comments = $post->comments;
?>
@foreach($comments as $comment)
<div class="display-comment">
    <?php
    $commenter = DB::table('normal_user')->where('id', $comment->user_id)->first();

    ?>
    <p style="display:flex;"><strong>{{ $commenter->name }}</strong>
    <h6>{{$commenter->role}}</h6>
    </p>
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
    <div class="space">
        @foreach($replies as $reply)
        <div class="display-replies">

            <?php
            $replier = DB::table('normal_user')->where('id', $reply->user_id)->first();
            ?>
            <p style="display:flex;"><strong>{{ $replier->name }}</strong>
            <h6>{{$replier->role}}
            </h6>
            </p>
            <p>{{ $reply->comment }}</p>
            <hr>

        </div>
        @endforeach
    </div>
</div>
@endforeach