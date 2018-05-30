<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ListsController extends Controller
{

    public function __construct(){

        $this->middleware('auth')->except(['index', 'show']);

    }

    public function lists(){

        $list = Post::where('user_id', Auth::id())->paginate(3);

        return view('posts.list', compact('list'));
    }

    public function ajax(){

        $list = Post::where('user_id', Auth::id())->paginate(3);

        return view('posts.productlist', compact('list'));

    }
}