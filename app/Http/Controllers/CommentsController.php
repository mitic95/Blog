<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Support\Facades\Auth;

use App\Comment;

class CommentsController extends Controller
{
    public function store(Post $post){

        $this->validate(request(), ['body' => 'required|min:2']);

        // $post->addComment(request('body'));

        // return back();

        // add a comment to a post

        if(!auth::user()){

            return redirect('/login');

        }

             Comment::create([
                'body' => request('body'),
                'post_id' => $post->id,
                'user_id' => auth::id()
           ]);

        return back();
    }
}