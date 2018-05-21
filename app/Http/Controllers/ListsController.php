<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ListsController extends Controller
{
    public function lists(){

        $list = Post::where('user_id', Auth::id())->paginate(2);

        return view('posts.list', compact('list'));

    }
}