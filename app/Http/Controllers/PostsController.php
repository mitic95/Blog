<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Posts;

use Carbon\Carbon;

class PostsController extends Controller
{
    public function __construct(){

        $this->middleware('auth')->except(['index', 'show']);

    }

    public function index(){

        $posts = Post::latest()

            ->filter(request(['month', 'year']))

            ->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function edit($id){

        $post = Post::find($id);

        return view('posts.edit', compact('post'));

    }

    public function create(){
        return view('posts.create');
    }

    public function store(){

        $this->validate(request(), [

            'title' => 'required',

            'body' => 'required'

        ]);


        auth()->user()->publish(

            new Post(request(['title', 'body']))

        );


        // flash message.

        session()->flash(

            'message', 'Your post has now been published'

        );


        return redirect('/');

        // Create a new post using the request data:

            // $post = new Post;

            // $post->title = request('title');
            // $post->body = request('body');

        // save it to the database:

            // $post->save();

        // and then redirect to the home page:

            // return redirect('/');

    }

    public function update($id){

        $this->validate(request(), [

            'title' => 'required',

            'body' => 'required'

        ]);

        $post = Post::find($id);
        $post->title = request('title');
        $post->body = request('body');
        $post->save();

        return redirect('/');

    }

    public function getDeletePost($post_id){

        $post = Post::where('id', $post_id)->first(); // ('id', '$post_id') po default-u je '=='

        if(Auth::user() != $post->user){

            return redirect()->home();

        }

        $post->delete();

        return redirect('/');

    }
}