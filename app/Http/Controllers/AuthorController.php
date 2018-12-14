<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $author = Post::where('user_id', $id)->paginate(3);

        $authorName = User::where('id', $id)->first();

        return view('posts.author', compact('author', 'authorName'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajax($id)
    {
        $author = Post::where('user_id', $id)->paginate(3);

        return view('posts.productauthor', compact('author'));
    }
}
