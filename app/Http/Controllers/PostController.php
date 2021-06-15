<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Guardian;
use Auth;
use DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::take(5)->get();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'body' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect('post')
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post;
        $post->user()->associate($request->user());
        $post->title = $request->title;
        $post->slug = \Str::slug($request->title);
        $post->body = $request->body;
        $user = DB::table('guardians')->where('user_id', Auth::user()->id)->first();
        $post_guardian = Guardian::find($user->acct_holder_id);
        $post_guardian->posts()->save($post);
        $post->save();

        return redirect()->back();
    }

    public function show(Post $post)
    {

        return view('post.single', compact('post'));
    }
}
