<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Validator;
use Input;
use Auth;


class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        var_dump($request->user_id);
        $comment = new Comment;
        $comment->user_id=Auth::user()->id;
        $comment->comment = $request->comment;

        // $comment->Guardian()->associate($request->Guardian());

        $post = Post::find($request->post_id);

        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = $request->get('comment');

        $reply->Guardian()->associate($request->Guardian());

        $reply->parent_id = $request->get('comment_id');

        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back();

    }
}
