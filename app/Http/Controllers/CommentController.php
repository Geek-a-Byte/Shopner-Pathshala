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
        $post->comments()->save($reply);
        return back();
    }
}
