<?php

namespace App\Http\Controllers\PostComment;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;


use Auth;


class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->user()->associate($request->user());
        $comment->comment = $request->comment;
        $post = Post::find($request->post_id);
        $comment->post_id = $request->post_id;
        $post->comments()->save($comment);
        return back();
    }

    public function replyStore(Request $request)
    {

        $reply = new Comment();
        $reply->comment = $request->get('comment');
        $reply->user_id = Auth::user()->id;
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));
        $reply->post_id = $request->post_id;
        $post->comments()->save($reply);
        return back();
    }
}
