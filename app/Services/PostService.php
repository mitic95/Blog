<?php

/**
 * Created by PhpStorm.
 * User: marko
 * Date: 6/15/18
 * Time: 10:34 AM
 */

namespace App\Services;

use App\Post;

class PostService
{
    /**
     * @param array $attributes
     * @return Post
     */
    public function createPost(array $attributes): Post
    {
        /** @var Post $post */
        $post = new Post($attributes);
        $post->save();

        return $post;
    }

    public function updatePost(array $attributes)
    {
        $id = $attributes['id'];
        $user_id = $attributes['user_id'];
        $post = Post::where($user_id)->findOrFail($id);
        $post->title = request('title');
        $post->body = request('body');

        return $post;
    }

    public function deletePost(array $attributes)
    {
        $post = Post::where($attributes);

        return $post;
    }
}