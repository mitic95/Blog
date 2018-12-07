<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;

/**
 * Class ListsController
 * @package App\Http\Controllers
 */
class ListsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lists()
    {
        $list = Post::where('user_id', Auth::id())->paginate(3);

        return view('posts.list', compact('list'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajax()
    {
        $list = Post::where('user_id', Auth::id())->paginate(3);

        return view('posts.productlist', compact('list'));
    }
}