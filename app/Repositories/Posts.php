<?php

namespace App\Repositories;

use App\Post;
use App\Redis;

class Posts
{
    protected $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function all()
    {
        // Return all posts.
        return Post::all();
    }

}