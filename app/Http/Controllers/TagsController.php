<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->paginate(5); // ukoliko stavimo $tag->posts onda nece raditi posto vracamo kolekciju, i na to ne moze da nadovezemo paginate() metodu.

        return view('posts.tag', compact('posts'));
    }
}