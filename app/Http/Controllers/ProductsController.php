<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class ProductsController extends Controller
{
    public function ajax(){

        $posts = Post::latest()

            ->filter(request(['month', 'year']))

            ->paginate(5);

        return view('posts.product', compact('posts'));

    }
}
