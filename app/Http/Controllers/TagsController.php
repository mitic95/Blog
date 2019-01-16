<?php

namespace App\Http\Controllers;

use App\Tag;

/**
 * Class TagsController
 * @package App\Http\Controllers
 */
class TagsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->paginate(5); // ukoliko stavimo $tag->posts onda nece raditi posto vracamo kolekciju, i na to ne moze da nadovezemo paginate() metodu.

        return view('posts.tag', compact('posts', 'tag'));
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajax(Tag $tag)
    {
        $posts = $tag->posts()->paginate(5);

        return view('posts.tags', compact('posts'));
    }
}