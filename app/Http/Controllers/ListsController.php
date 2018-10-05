<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ListsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function lists()
    {
        //DB::connection()->enableQueryLog();
        $list = Post::where('user_id', Auth::id())->paginate(3);
        //$test = DB::getQueryLog();
        //print_r($test);

        return view('posts.list', compact('list'));
    }

    public function ajax()
    {
        $list = Post::where('user_id', Auth::id())->paginate(3);

        return view('posts.productlist', compact('list'));
    }
}